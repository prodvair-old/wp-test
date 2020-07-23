import initAjaxForm from '../components/ajaxForm';
import burgerMenu from '../components/burgerMenu';

export default {
  init() {
    initAjaxForm('#customFrom', 'send_message');
    burgerMenu();
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
