import './bootstrap';
import Tribute from 'tributejs'
import 'tributejs/dist/tribute.css'
import mentionable from './plugins/mentionable.js'
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm.js'

window.Tribute = Tribute

Alpine.plugin(mentionable)

Livewire.start()
