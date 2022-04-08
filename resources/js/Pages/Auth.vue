<template>
  <div class="w-screen h-screen flex flex-col items-center justify-center">
    <img
      class="w-3/4 md:w-1/3 lg:w-1/5"
      src="/img/logos/cendrassos.png"
      draggable="false"
      alt="Logo Cendrassos"
    />

    <div v-if="$page.props.flash.error">
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
        <img
          class="w-8"
          src="/img/logos/google.png"
          draggable="false"
          alt="Logo Google"
        />
        <span>Accedir amb <strong>Google</strong></span>
      </a>

      <a
        class="flex items-center gap-3 w-full h-14 px-3 bg-white rounded-lg hover:bg-gray-100"
        href="/accedir/discord"
      >
        <img
          class="w-8"
          src="/img/logos/discord.png"
          draggable="false"
          alt="Logo Discord"
        />
        <span>Accedir amb <strong>Discord</strong></span>
      </a>

      <a
        class="flex items-center gap-3 w-full h-14 px-3 bg-white rounded-lg hover:bg-gray-100"
        href="/accedir/github"
        as="button"
      >
        <img
          class="w-8"
          src="/img/logos/github.png"
          draggable="false"
          alt="Logo GitHub"
        />
        <span>Accedir amb <strong>GitHub</strong></span>
      </a>

      <a
        class="flex items-center gap-3 w-full h-14 px-3 bg-white rounded-lg hover:bg-gray-100"
        href="/accedir/gitlab"
      >
        <img
          class="w-8"
          src="/img/logos/gitLab.png"
          draggable="false"
          alt="Logo GitLab"
        />
        <span>Accedir amb <strong>GitLab</strong></span>
      </a>
    </div>
  </div>
</template>
