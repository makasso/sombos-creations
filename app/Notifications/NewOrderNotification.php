<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Filament\Notifications\Notification as FilamentNotification;

class NewOrderNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Order $order)
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $orderNumber = '#' . str_pad($this->order->id, 5, '0', STR_PAD_LEFT);
        $customerName = $this->order->getCustomerName();
        $amount = '$' . number_format($this->order->total_amount, 2);

        return FilamentNotification::make()
            ->title("New Order {$orderNumber}")
            ->body("{$customerName} placed an order for {$amount}")
            ->icon('heroicon-o-shopping-bag')
            ->iconColor('success')
            ->actions([
                \Filament\Notifications\Actions\Action::make('view')
                    ->label('View Order')
                    ->url(url('/admin/orders/' . $this->order->id))
                    ->markAsRead(),
            ])
            ->getDatabaseMessage();
    }
}
