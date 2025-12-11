
import { createI18n } from 'vue-i18n'
const i18n = new createI18n({
    legacy: false,
    locale: window.locale ? window.locale : 'en',
    fallbackLocale: 'en',
    messages: {
        'en': import('../locale/en.json'),
    },
})


export default i18n;