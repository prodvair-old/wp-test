export default () => {
  $('.header__content__nav-burger').on('click', (e) => {
    e.preventDefault();
    $('.header__content__nav-burger').toggleClass('active');
    $('.header__content__nav').toggleClass('active');
  })
}
