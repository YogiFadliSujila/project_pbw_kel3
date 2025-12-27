<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // 1. Tampilkan Daftar Chat & Room Tertentu
    public function index(Request $request)
    {
        $userId = Auth::id();

        // Ambil semua percakapan user ini
        $conversations = Conversation::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['messages', 'sender', 'receiver', 'property'])
            ->latest()
            ->get();

        // Jika ada parameter ?conversation_id=X, load chat tersebut
        $activeConversation = null;
        if ($request->has('conversation_id')) {
            $activeConversation = $conversations->where('id', $request->conversation_id)->first();
            
            // Tandai pesan sudah dibaca
            if($activeConversation) {
                Message::where('conversation_id', $activeConversation->id)
                    ->where('user_id', '!=', $userId)
                    ->update(['is_read' => true]);
            }
        }

        return view('chat.index', compact('conversations', 'activeConversation'));
    }

    // 2. Logika "Hubungi Penjual" (Cek Room atau Buat Baru)
    public function initiate(Request $request)
    {
        $senderId = Auth::id();
        $receiverId = $request->receiver_id;
        $propertyId = $request->property_id;

        // Cek apakah sudah ada percakapan antara 2 orang ini
        $conversation = Conversation::where(function($q) use ($senderId, $receiverId) {
            $q->where('sender_id', $senderId)->where('receiver_id', $receiverId);
        })->orWhere(function($q) use ($senderId, $receiverId) {
            $q->where('sender_id', $receiverId)->where('receiver_id', $senderId);
        })->first();

        // Jika belum ada, buat baru
        if (!$conversation) {
            $conversation = Conversation::create([
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'property_id' => $propertyId
            ]);
        }

        // Redirect ke halaman chat dengan membuka ID percakapan ini
        return redirect()->route('chat.index', ['conversation_id' => $conversation->id]);
    }

    // 3. Kirim Pesan
    public function send(Request $request, $conversationId)
    {
        $request->validate(['body' => 'required']);

        Message::create([
            'conversation_id' => $conversationId,
            'user_id' => Auth::id(),
            'body' => $request->body
        ]);
        
        // Update timestamp percakapan agar naik ke atas list
        Conversation::find($conversationId)->touch();

        return back();
    }
}