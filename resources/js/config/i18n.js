
import { createI18n } from 'vue-i18n'
import en from '../locale/en.json'
const i18n = new createI18n({
    legacy: false,
    locale: window.locale ? window.locale : 'en',
    fallbackLocale: 'en',
    messages: {
        en
    },
})


export default i18n;