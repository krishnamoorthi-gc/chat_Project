<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PricingPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PricingPlan::updateOrCreate(
            ['name' => 'Free'],
            [
                'price' => 0.00,
                'description' => 'Perfect for getting started',
                'features' => ['1 Chatbot', '100 Messages/mo', 'Basic Analytics'],
                'payment_url' => '#',
            ]
        );

        \App\Models\PricingPlan::updateOrCreate(
            ['name' => 'Pro'],
            [
                'price' => 29.00,
                'description' => 'For growing businesses',
                'features' => ['5 Chatbots', 'Unlimited Messages', 'Advanced Analytics', 'Custom Training'],
                'payment_url' => 'https://buy.stripe.com/test_...',
            ]
        );

        \App\Models\PricingPlan::updateOrCreate(
            ['name' => 'Enterprise'],
            [
                'price' => 99.00,
                'description' => 'Maximum power and support',
                'features' => ['Unlimited Chatbots', 'Priority Support', 'API Access', 'White Labeling'],
                'payment_url' => 'https://buy.stripe.com/test_...',
            ]
        );
    }
}
