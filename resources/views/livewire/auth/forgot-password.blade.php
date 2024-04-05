<?php
include_once 'forgot-password.php';
?>

<div>
    <x-card class="h-screen flex items-center" title="{{__('Password renewal')}}" subtitle="{{__('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.')}}" shadow separator>
        <x-session-status class="mb-4" :status="session('status')" />
        <x-form wire:submit="sendPasswordResetLink">
            <x-input label="{{__('Ex7-mail')}}" wire:model="email" icon="o-envelope" inline />

            <x-slot:actions>
               <x-button label="{{ __('Email Password Reset Link') }}" type="submit" icon="o-paper-airplane" class="btn-primary" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
