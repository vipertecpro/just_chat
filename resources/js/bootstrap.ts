import axios from 'axios';
import {initFlowbite} from "flowbite";
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

initFlowbite();
