<template>
    <ModalComponent v-model="value">
        <template #title>
            <img :src="asset('images/logo.jpeg')" class="w-40 h-auto mx-auto"/>
            <h1 class="px-4 py-2 text-2xl font-extrabold text-center bg-stone-200">
                How to Play
            </h1>
        </template>
        <template #content>
            <p class="my-4 -mt-4">
                You have three tries to guess the featured number.
                Press the check mark to submit.
            </p>

            <p class="my-4">
                After each guess, the colors will change to show how close you got!
            </p>

            <p class="my-4">
                If you guess correctly, <span class="font-bold">you have a chance to submit your own numbers to be featured!</span>
            </p>

            <p class="my-4">
                <img :src="asset('images/help_green.png')" class="w-2/3" />
                <span class="font-bold">Green</span> indicates the number is in the proper spot.
            </p>

            <p class="my-4">
                <img :src="asset('images/help_yellow.png')" class="w-2/3" />
                <span class="font-bold">Yellow</span> indicates the number is correct, but in the wrong spot.
            </p>

            <p class="my-4">
                <img :src="asset('images/help_double.png')" class="w-2/3" />
                A <span class="font-bold">Purple</span> line indicates the number is used multiple times.
            </p>

            <div class="flex justify-center my-4">
                <el-button type="success" size="large" :tabindex="-1" @click="handleReadHelp">GOT IT, LET'S PLAY</el-button>
            </div>

            <hr/>
            <p class="font-light text-center">
                <span class="font-bold">New Numbers updated every 12 hours!</span>
                <br/>
                12:00am PST / 12:00pm PST
            </p>
            <div class="flex items-center justify-center">
                <el-link href="https://www.guessmynumbers.com" target="_blank" type="primary">
                    www.guessmynumbers.com
                </el-link>
            </div>
        </template>
    </ModalComponent>
</template>
<script>
import ModalComponent from "../ui/ModalComponent";
import IconComponent from "../ui/IconComponent";

export default {
    components: {IconComponent, ModalComponent},
    props: ['modelValue'],
    emits: ['update:modelValue'],
    computed: {
        value: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.$emit('update:modelValue', value);
            },
        },
    },
    methods: {
        handleReadHelp() {
            this.$gtag.event('readHelp', { 'event_category': 'UserBehavior' });
            this.value = false;
        },
    },
}
</script>
