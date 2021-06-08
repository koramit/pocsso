<template>
    <div>
        <form @submit.prevent="submit">
            <div>
                <label for="login">login :</label>
                <input type="text" name="login" id="login" v-model="form.login" required>
                <p style="color: red;" v-if="form.errors.login">{{ form.errors.login }}</p>
            </div>
            <div>
                <label for="password">password :</label>
                <input type="password" name="password" id="password" v-model="form.password" required>
            </div>
            <input type="submit" value="login">
        </form>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    data () {
        return {
            form: useForm({
                login: null,
                password: null,
            })
        }
    },

    methods: {
        submit () {
            this.form.post(`${this.$page.props.baseUrl}/login`)
        }
    }
}
</script>