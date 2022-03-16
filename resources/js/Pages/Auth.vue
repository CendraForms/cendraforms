<template>
  <div class="w-screen h-screen flex flex-col items-center justify-center">
    <img class="w-3/4 md:w-1/3 lg:w-1/5" src="/logo.png" draggable="false" />

    <div v-if="$page.props.flash.error ">
      {{ $page.props.flash.error }}
    </div>

    <div
      class="w-1/5 mt-10 flex flex-col gap-2 text-lg font-medium text-zinc-900 leading-none"
    >
      <a
        class="flex items-center gap-3 w-full h-14 px-3 bg-white rounded-lg hover:bg-gray-100"
        href="/accedir/google"
        as="button"
      >
        <img class="w-8" src="/logos/google.png" draggable="false" />
        <span>Accedir amb <b>Google</b></span>
      </a>

      <a
        class="flex items-center gap-3 w-full h-14 px-3 bg-white rounded-lg hover:bg-gray-100"
        href="/accedir/discord"
      >
        <img class="w-8" src="/logos/discord.png" draggable="false" />
        <span>Accedir amb <b>Discord</b></span>
      </a>

      <a
        class="flex items-center gap-3 w-full h-14 px-3 bg-white rounded-lg hover:bg-gray-100"
        href="/accedir/github"
        as="button"
      >
        <img class="w-8" src="/logos/github.png" draggable="false" />
        <span>Accedir amb <b>GitHub</b></span>
      </a>

      <a
        class="flex items-center gap-3 w-full h-14 px-3 bg-white rounded-lg hover:bg-gray-100"
        href="/accedir/gitlab"
        as="button"
      >
        <img class="w-8" src="/logos/gitLab.png" draggable="false" />
        <span>Accedir amb <b>GitLab</b></span>
      </a>
    </div>
  </div>
</template>
