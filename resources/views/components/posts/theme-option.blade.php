<div class="relative">
    <input type="radio" name="default_post_theme" id="{{ $id }}" value="{{ $id }}" class="sr-only peer" @if($checked) checked @endif>
    <label for="{{ $id }}" class="block aspect-video rounded-lg overflow-hidden cursor-pointer transition-all duration-200 hover:scale-105 border-[3px] border-transparent-blue-500 peer-checked:border-blue-600 peer-checked:scale-105 peer-checked:shadow-md">
        <div class="h-full {{ $bgColor }} flex justify-center items-center">
            <div class="w-2/3 h-4/5 {{ $contentBgColor }} rounded p-2 flex flex-col">
                <div class="w-3/4 h-2 {{ $highlightColor }} rounded mb-1"></div>
                <div class="w-1/2 h-2 {{ $highlightColor }} rounded mb-2"></div>
                <div class="w-full h-1 {{ $highlightColor }} rounded mb-1"></div>
                <div class="w-full h-1 {{ $highlightColor }} rounded mb-1"></div>
                <div class="w-3/4 h-1 {{ $highlightColor }} rounded"></div>
            </div>
        </div>
    </label>
</div>
