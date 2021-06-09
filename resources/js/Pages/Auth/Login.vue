<template>
    <!-- <div>
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
    </div> -->
    <div class="min-h-screen flex justify-center items-center bg-gradient-to-br from-blue-200 to-blue-800">
        <div class="rounded-lg border-t-8 border-b-8 border-blue-600 shadow-md p-4 bg-white">
            <form @submit.prevent="submit">
            <div>
                <label class="mt-2 font-semibold" for="login">login :</label>
                <input class="form-input" type="text" name="login" id="login" v-model="form.login" required>
                <p class="text-red-400 text-xs" v-if="form.errors.login">{{ form.errors.login }}</p>
            </div>
            <div>
                <label class="mt-2 font-semibold" for="password">password :</label>
                <input class="form-input" type="password" name="password" id="password" v-model="form.password" required>
            </div>
            <div class="float-right">
                <button class="mt-2 p-2 rounded shadow bg-blue-400 hover:bg-blue-600 cursor-pointer text-white transition-colors duration-300 ease-in-out" type="submit">login</button>
            </div>
            </form>
        </div>
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