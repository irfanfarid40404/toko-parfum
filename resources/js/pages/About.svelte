
<script lang="ts">
    type Props = {
        appName: string;
        laravelVersion: string;
        features: string[];
    };

    let { appName, laravelVersion, features }: Props = $props();
</script>

<svelte:head>
    <title>Tentang - {appName}</title>
</svelte:head>

<div class="p-8">
    <h1 class="text-3xl font-bold">
        Tentang {appName}
    </h1>

    <p class="mt-4">
        Aplikasi ini dibangun menggunakan Laravel
        versi {laravelVersion}.
    </p>

    <h2 class="mt-8 text-xl font-semibold">
        Fitur Aplikasi
    </h2>

    <ul class="mt-4 list-disc space-y-2 pl-6">
        {#each features as feature}
            <li>{feature}</li>
        {/each}
    </ul>
</div>
