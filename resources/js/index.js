import './bootstrap'
import 'es6-promise/auto'

import { createApp } from 'vue'
import App from './App'
import router from './Router'
import {store} from './Store'

const el = document.querySelector('#app');

const app = createApp(App)

app.use(store)
app.use(router)
app.mount(el)