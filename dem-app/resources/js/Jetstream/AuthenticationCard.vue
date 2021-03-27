<template>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-3 sm:pt-0 bg-cerise-50">
        <div>
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md mt-3 px-4 lg:px-0 py-4 bg-cerise-50 overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
