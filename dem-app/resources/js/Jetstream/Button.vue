<template>

    <button :type="type" class="inline-flex items-center px-4 py-2 bg-cerise-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cerise-700 active:bg-cerise-900 focus:outline-none focus:border-cerise-900 focus:shadow-outline-cerise transition ease-in-out duration-150">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    }
</script>
