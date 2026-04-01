/**
 *
 * Inicializa todos los Swiper del DOM marcados con [data-swiper].
 * La configuración se pasa como JSON en el atributo data-swiper-config.
 */

import Swiper from 'swiper'
import { Navigation, A11y } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/navigation'

export function initSliders() {
    document.querySelectorAll('[data-swiper]').forEach((el) => {
        const raw = el.dataset.swiperConfig || '{}'
        const config = JSON.parse(raw)

        new Swiper(el, {
            modules: [Navigation, A11y],
            a11y: { enabled: true },
            ...config,
        })
    })
}
