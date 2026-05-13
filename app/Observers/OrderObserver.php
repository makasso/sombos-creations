<?php

namespace App\Observers;

use App\Mail\NewOrderAdminMail;
use App\Mail\OrderStatusUpdatedMail;
use App\Models\Order;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Facades\Mail;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     * Send notification + email to admin when a new order is placed.
     */
    public function created(Order $order): void
    {
        // Send email to all admin users
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            // Send database notification (appears in Filament panel)
            $admin->notify(new NewOrderNotification($order));

            // Send email notification
            Mail::to($admin->email)->send(new NewOrderAdminMail($order));
        }
    }

    /**
     * Handle the Order "updated" event.
     * Send email to customer when order status changes.
     */
    public function updated(Order $order): void
    {
        // Only send if status actually changed
        if ($order->isDirty('status')) {
            $oldStatus = $order->getOriginal('status');
            $newStatus = $order->status;

            $customerEmail = $order->getCustomerEmail();

            if ($customerEmail) {
                Mail::to($customerEmail)->send(
                    new OrderStatusUpdatedMail($order, $oldStatus, $newStatus)
                );
            }
        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
