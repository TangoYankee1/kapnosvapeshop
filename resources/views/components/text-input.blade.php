@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-700 focus:border-white focus:ring-white rounded-md shadow-sm text-black']) }}>
