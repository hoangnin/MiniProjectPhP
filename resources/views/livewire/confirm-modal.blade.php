<div>
    <flux:modal name="{{$name}}" class="min-w-[22rem]" :show-close="false">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{$title}}</flux:heading>
                <flux:text class="mt-2">
                    {!! $message !!}
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer/>
                <flux:modal.close>
                    <flux:button wire:click="cancel" variant="ghost" >Cancel</flux:button>
                </flux:modal.close>

                <flux:button wire:click="confirm" variant="{{$confirmVariant}}">
                    {{$confirmText}}
                </flux:button>

            </div>
        </div>
    </flux:modal>
</div>
