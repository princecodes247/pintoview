<div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
    <x-theme-option id="light" bgColor="bg-white" contentBgColor="bg-gray-100" highlightColor="bg-gray-600" checked="{{ $selectedTheme === 'light' }}"/>
    <x-theme-option id="dark" bgColor="bg-gray-900" contentBgColor="bg-gray-800" highlightColor="bg-gray-300" checked="{{ $selectedTheme === 'dark' }}"/>
    <x-theme-option id="sepia" bgColor="bg-amber-50" contentBgColor="bg-amber-100" highlightColor="bg-amber-900" checked="{{ $selectedTheme === 'sepia' }}"/>
    <x-theme-option id="forest" bgColor="bg-green-900" contentBgColor="bg-green-800" highlightColor="bg-green-100" checked="{{ $selectedTheme === 'forest' }}"/>
    <x-theme-option id="ocean" bgColor="bg-blue-900" contentBgColor="bg-blue-800" highlightColor="bg-blue-100" checked="{{ $selectedTheme === 'ocean' }}"/>
    <x-theme-option id="sunset" bgColor="bg-orange-100" contentBgColor="bg-orange-200" highlightColor="bg-orange-800" checked="{{ $selectedTheme === 'sunset' }}"/>
</div>
