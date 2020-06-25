$(document).ready(function () {
  $.browser.device = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));

  $('.location-selector select').change(function () {
    $('.main-background-content').slick('unslick');
  });

  function slickInit() {
    let selected = $('.location-selector select').val();
    const device = !$.browser.device ? 'desktop' : 'mobile';
    $.get(ajaxUrl, { city: selected,device : device }, function (data, textStatus, jqXHR) {
      collection_data = data.data
      var imageObject = []
      
      Object.keys(collection_data).map(function (item) {
        if (collection_data[item] != null){
          imageObject.push('<div><img data-lazy="' + collection_data[item] + '" /></div>')
        }
      })
      
      $('.main-background-content').html(imageObject.join(''));
      $('.main-background-content').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        lazyLoad: 'ondemand',
        arrows: !$.browser.device,
        fade: true,
      });
    });
    
  }
  slickInit();

  $('.main-background-content').on('destroy', function (event, slick) {
    slickInit();
  });

  $('.main-background-content').on('init', function (slick) {
  });

  $('.main-background-content').on('lazyLoaded', function (event, slick) {
    reposition();
  });

  function reposition() {
    let rect = $('.main-background-content img:eq(' + $('.main-background-content').slick('getSlick').getCurrent() + ')').get(0).getBoundingClientRect();
    // $('.credit').css('top', 'calc(' + rect.bottom + 'px - 1rem)');
    $('.credit').css('left', 'calc(' + rect.right + 'px - 98px)');

    $('.slick-prev').css('width', rect.left + 'px');
    $('.slick-next').css('width', 'calc(100vw - ' + rect.right + 'px)');

    $('.marker').css('left', 'calc(' + rect.left + 'px + 2rem)');
    $('.location-selector').css('left', 'calc(' + rect.left + 'px + 2rem)');
  }

  $('.main-background-content').on('afterChange', function (event, slick, currentSlide) {
    reposition();
  });
});
