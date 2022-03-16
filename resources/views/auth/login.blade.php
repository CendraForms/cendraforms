<x-app-layout>
    <div class="w-screen h-screen flex flex-col items-center justify-center bg-red-700">
        <img class="w-3/4 md:w-1/3 lg:w-1/5" src="/logo.png" draggable="false">

        <div class="w-3/4 md:w-1/2 lg:w-1/5 mt-10 flex flex-col gap-2 text-lg md:text-xl text-red-700 leading-none">
            <button class="flex items-center gap-3 w-full h-14 px-3 bg-white rounded-lg hover:bg-gray-100">
                <img class="w-8" src="/logos/google.png" draggable="false">
                <span>Accedir amb <b>Google</b></span>
            </button>

            <button class="flex items-center gap-3 w-full h-14 px-3 bg-white rounded-lg hover:bg-gray-100">
                <img class="w-8" src="/logos/discord.png" draggable="false">
                <span>Accedir amb <b>Discord</b></span>
            </button>

            <button class="flex items-center gap-3 w-full h-14 px-3 bg-white rounded-lg hover:bg-gray-100">
                <img class="w-8" src="/logos/github.png" draggable="false">
                <span>Accedir amb <b>GitHub</b></span>
            </button>

            {{-- GitLab OAuth --}}
            <a href="{{ route('AuthGitlabRedirect') }}" class="flex items-center gap-3 w-full h-14 px-3 bg-white rounded-lg hover:bg-gray-100">
                <img class="w-8" src="/logos/gitLab.png" draggable="false">
                <span>Accedir amb <b>GitLab</b></span>
            </a>
        </ul>
    </div>
</x-app-layout>
