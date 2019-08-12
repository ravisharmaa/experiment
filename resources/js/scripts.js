$(document).ready(function () {

  // Custom dropwdown menu
  $('.drop-down-toggle').click(function () {
    myDropDown = $(this).next('.drop-down-wrapper')

    if (myDropDown.is(':visible')) {
      $(this).removeClass('drop-down-open')
      myDropDown.hide()
    } else {
      myDropDown.fadeIn(1500)
      $(this).addClass('drop-down-open')
    }
    return false
  })

  // Custom dropwdown menu making hide on clicking outside
  $('html').click(function (e) {
    $('.drop-down-wrapper').hide()
  })

  $('.drop-down-wrapper').click(function (e) {
    e.stopPropagation()
  })

  /*Name Auto Suggestion*/
  $('body').on('keyup', '#namesearch', function () {
    autoSuggest()
  })

  // RightSide-panel
  $('.right-sidebar-toggler, .cs-overLay, #rightsidebarclose, #close').on('click', function () {
    toggleFunctionHandler()
  })

  /*Function to close the search side bar*/
  function toggleFunctionHandler () {
    $('#right-sidebar').toggleClass('open')
    $('.cs-overLay').toggleClass('open')

  }

  $('.expanderDom').on('click', function () {
    var id = $(this).attr('id');
    $('#' + id).toggleClass("open");
    $('#' + id).parent().toggleClass("hasExpanderDomOpen");
    $('#' + id).parent().parent().parent().toggleClass("open");
    $('#' + id).parent().parent().parent().parent().toggleClass("hasExpanderDomOpen");

    if ($(this).hasClass('open')) {
      $(this).html('View less');
    } else {
      $(this).html('View more');
    }
  });
})
