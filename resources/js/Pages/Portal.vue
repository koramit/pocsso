<template>
    <div>
        <h1>Hello PORTAL</h1>
        <inertia-link
            v-for="app in applications"
            :key="app.id"
            :href="`${$page.props.baseUrl}/applications/${app.id}/login`"
            method="post"
            type="button"
            as="button"
        >{{ app.label }}</inertia-link>

        <inertia-link
            :href="`${$page.props.baseUrl}/logout`"
            method="post"
            type="button"
            as="button"
        >logout</inertia-link>
    </div>
</template>

<script>
export default {
    props: ['applications']
}
</script>