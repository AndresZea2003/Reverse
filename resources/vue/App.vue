<template>
 Vue instalado
    <button @click="sesion()">click</button>
    <div id="value"></div>
    <a :href="url">go</a>

    <input type="text" :value="login">
    <input type="text" :value="secretKey">
    <input type="text" :value="nonce64">
    <input type="text" :value="seed">
</template>
<script setup>
import axios from 'axios'
import {ref} from "vue";
import moment from 'moment';
import CryptoJS from 'crypto-js'

const id = ref()
const url = ref()

const login = 'd37bcd8b16f5add4d0f7cf32a938e6e5'
const secretKey = '2gF5Tw5z7w85d2H0'
const nonce = Math.random().toString(36).substring(2,10);
const nonce64 = btoa(nonce)
const seed = moment().format();

let SHA1 = CryptoJS.SHA1(nonce + seed + secretKey);
let tranKey = SHA1.toString(CryptoJS.enc.Base64);

console.log(tranKey)

</script>
<style>

</style>
