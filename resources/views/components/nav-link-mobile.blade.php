<a 
    {{ $attributes }}
    class="{{ $active ? 'bg-blue-900 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">
    {{ $slot }}    
</a>