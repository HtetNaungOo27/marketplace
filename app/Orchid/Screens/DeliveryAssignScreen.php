<?php

namespace App\Orchid\Screens;

use App\Models\Delivery;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class DeliveryAssignScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'deliveries' => Delivery::with(['order.customer.user', 'deliveryStaff'])
                ->latest()
                ->get(),
        ];
    }

    public function name(): ?string
    {
        return 'Delivery Assignment';
    }

    public function description(): ?string
    {
        return 'Assign delivery staff to shipped orders.';
    }

    public function layout(): iterable
    {
        return [
            Layout::table('deliveries', [
                TD::make('id', 'ID'),

                TD::make('order_id', 'Order')
                    ->render(fn(Delivery $delivery) => '#' . $delivery->order_id),

                TD::make('tracking_number', 'Tracking'),

                TD::make('order.customer.user.name', 'Customer'),

                TD::make('deliveryStaff.name', 'Assigned Staff')
                    ->render(fn(Delivery $delivery) => $delivery->deliveryStaff->name ?? 'Not assigned'),

                TD::make('delivery_status', 'Status'),

                TD::make('Assign Staff')
                    ->render(function (Delivery $delivery) {
                        $staff = User::where('role', 'Delivery')->first();

                        if (!$staff) {
                            return 'No delivery staff';
                        }

                        return Button::make('Assign to ' . $staff->name)
                            ->method('assign', [
                                'delivery_id' => $delivery->id,
                                'staff_id' => $staff->id,
                            ]);
                    }),
            ]),
        ];
    }

    public function assign(Request $request): void
    {
        Delivery::findOrFail($request->get('delivery_id'))->update([
            'delivery_staff_id' => $request->get('staff_id'),
        ]);
    }
}
