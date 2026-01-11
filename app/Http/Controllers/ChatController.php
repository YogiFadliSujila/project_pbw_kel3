<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyDeal;
<<<<<<< HEAD
=======
use App\Notifications\NewMessageReceived;
use App\Models\User;
>>>>>>> origin/memperbaiki-landing

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
<<<<<<< HEAD

        Message::create([
=======
        $message = Message::create([
>>>>>>> origin/memperbaiki-landing
            'conversation_id' => $conversationId,
            'user_id' => Auth::id(),
            'body' => $request->body
        ]);
        
        // Update timestamp percakapan agar naik ke atas list
        Conversation::find($conversationId)->touch();

<<<<<<< HEAD
=======
        // Kirim notifikasi ke penerima (user lain di percakapan)
        try {
            $conv = Conversation::find($conversationId);
            if ($conv) {
                $receiverId = ($conv->sender_id == Auth::id()) ? $conv->receiver_id : $conv->sender_id;
                $receiver = User::find($receiverId);
                if ($receiver) {
                    $receiver->notify(new NewMessageReceived($message));
                }
            }
        } catch (\Exception $e) {
            // silent fail
        }

>>>>>>> origin/memperbaiki-landing
        return back();
    }
    // Kirim Tawaran Harga
    public function sendOffer(Request $request, $conversationId)
    {
        $request->validate([
            'offer_price' => 'required|numeric|min:1000'
        ]);

        Message::create([
            'conversation_id' => $conversationId,
            'user_id' => Auth::id(),
            'body' => 'Saya mengajukan penawaran harga.', // Text fallback
            'type' => 'offer',
            'offer_price' => $request->offer_price,
            'offer_status' => 'pending'
        ]);

<<<<<<< HEAD
=======
        // Notifikasi ke penerima
        try {
            $conv = Conversation::find($conversationId);
            if ($conv) {
                $lastMsg = Message::where('conversation_id', $conversationId)->latest()->first();
                $receiverId = ($conv->sender_id == Auth::id()) ? $conv->receiver_id : $conv->sender_id;
                $receiver = User::find($receiverId);
                if ($receiver && $lastMsg) {
                    $receiver->notify(new NewMessageReceived($lastMsg));
                }
            }
        } catch (\Exception $e) {}

>>>>>>> origin/memperbaiki-landing
        return back();
    }

    // Terima / Tolak Tawaran
    public function handleOffer($messageId, $status)
    {
        $message = Message::with('conversation')->findOrFail($messageId);
        
        if ($message->user_id == Auth::id()) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        // 1. Update Status di Chat Bubble
        $message->update(['offer_status' => $status]);

        // 2. JIKA DITERIMA -> SIMPAN KE PROPERTY DEALS
        if ($status == 'accepted') {
            
            $propertyId = $message->conversation->property_id; 

            // Simpan Kesepakatan Harga
            $deal = PropertyDeal::create([
                'user_id'      => $message->user_id, // ID Pembeli
                'property_id'  => $propertyId,
                'agreed_price' => $message->offer_price, // Harga Tawar
                'status'       => 'waiting_payment'
            ]);

            // Kirim Link Pembayaran yang mengarah ke Deal ID
            // Perhatikan parameternya: 'deal_id'
            $paymentLink = route('payment.show', ['deal_id' => $deal->id]);
            
            $responseText = "✅ Tawaran diterima! Harga sepakat: Rp " . number_format($message->offer_price,0,',','.');
        } else {
            $responseText = "❌ Maaf, tawaran Anda belum bisa saya terima.";
        }

        // 3. Kirim Balasan Otomatis
        Message::create([
            'conversation_id' => $message->conversation_id,
            'user_id' => Auth::id(),
            'body' => $responseText,
            'type' => 'text'
        ]);

<<<<<<< HEAD
=======
        // Notify original user that there's a reply
        try {
            $conv = $message->conversation;
            $lastMsg = Message::where('conversation_id', $conv->id)->latest()->first();
            $origUser = User::find($message->user_id);
            if ($origUser && $lastMsg) {
                $origUser->notify(new NewMessageReceived($lastMsg));
            }
        } catch (\Exception $e) {}

>>>>>>> origin/memperbaiki-landing
        return back();
    }
}