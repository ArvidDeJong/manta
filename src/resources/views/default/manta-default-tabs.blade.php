  @if (isset($tablistModule) && count($tablistModule) > 1)
      <flux:tabs class="mb-4 px-4" wire:model="tablistModuleShow">
          @foreach ($tablistModule as $tab)
              <flux:tab name="{{ $tab['name'] }}"><a href="{{ $tab['url'] }}">{{ $tab['title'] }}</a></flux:tab>
          @endforeach
      </flux:tabs>
  @endif
