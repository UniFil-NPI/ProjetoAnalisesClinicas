<script setup>

const props = defineProps({
    links: Array,
})

</script>

<template>
    <div class="flex justify-center space-x-2 mt-4">
        <component
            :is="link.url ? 'a' : 'span'"
            v-for="(link, i) in links"
            :key="i"
            :href="link.url"
            v-html="link.label"
            :class="[
                'px-3 py-1 rounded transition-all duration-200',
                link.active
                    ? 'bg-white border border-primary text-gray-800 font-semibold cursor-default'
                    : link.url
                    ? 'bg-primary text-white hover:bg-orange-300'
                    : 'bg-gray-100 text-gray-500 cursor-default',
            ]"
        />
    </div>
</template>
