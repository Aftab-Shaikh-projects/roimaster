var pag_no = 1;
var jq_data_table = true;
function pagination(page, purl, loader = '1', table_id = "alltable") {
  let isMT = "";
  if ($("#MultipleTables").val() ?? "" == "yes") {
    isMT = $("#" + table_id).attr("table_number") ?? "";
  }

  let filters_input = $(`select.filters , input.filters:checked , input.filters[type=range] , input.filters[type=text]`) ?? "";
  let filters = {};
  filters_input.each(function () {
    if (filters[$(this).attr("name")] == undefined) {
      filters[$(this).attr("name")] = [];
    }
    filters[$(this).attr("name")].push($(this).val());
  });

  edit_current_url(filters);

  let sent_data = {
    "page": page,
    "filters": filters,
    csrf: $("#csrf").attr("value")
  };

  if (loader == 2) {
    $("#" + table_id).html(`
        <div class='container d-flex justify-content-center' style="margin-top:50px;">
        <div class="col-3">
        <div class="snippet" data-title=".dot-spin">
          <div class="stage d-flex justify-content-center">
            <div class="dot-spin"></div>
          </div>
        </div>
      </div>
      </div>
      `);
  }



  $.ajax({
    url: "tables/" + purl,
    type: "POST",
    data: sent_data,
    success: function (data) {
      try {
        data = JSON.parse(data);
        showAlert(data["mess"], data["color"], data["other"]);
      } catch (error) {
        $("#" + table_id).html(data);
      }
      if (jq_data_table) {
        // $("#" + table_id).find("table").dataTable({
        //   responsive: true,
        //   "paging": false,
        //   "ordering": false,
        //   "info": false,
        //   "searching": false
        // });
      }
    },
    error: function (e) {
      showAlert("something went wrong!", "danger", "");
    }
  });
}


function PaginationBtn(e, purl) {
  let $btn = $(e);
  let main_div = $btn.closest("div").attr("id");
  let page_id = 1;

  let $active = $(".paginactive");
  let currentPage = parseInt($active.text(), 10);
  let $pagination = $(".pagination");
  let lastPage = $pagination.children().length - 4; // adjust for extra elements (first, prev, next, last)

  switch ($btn.attr("id")) {
    case "prev":
      if (currentPage > 1) {
        page_id = currentPage - 1;
        pagination(page_id, purl, 2, main_div);
      }
      break;

    case "next":
      if (currentPage < lastPage) {
        page_id = currentPage + 1;
        pagination(page_id, purl, 2, main_div);
      }
      break;

    case "first":
    case "last":
      page_id = $btn.attr("value"); // using .val() for button value
      pagination(page_id, purl, 2, main_div);
      break;

    default:
      page_id = $btn.attr("id");
      pagination(page_id, purl, 2, main_div);
  }

  window.pag_no = page_id; // keep global if required
}

if ($("#MultipleTables").val() ?? "" == "yes") {
  $("div[table_number]").each(function () {
    let val = $(this).attr("table_number");
    $(document).on("change click", "#searchforall" + val, function () {
      let val = $(this).attr("onkeyup");
      eval(val);
    })
  });
} else {
  $(document).on("change click", "#searchforall", function () {
    let val = $(this).attr("onkeyup");
    eval(val);
  })
}

function set_input_by_url() {
  const urlParams = new URLSearchParams(window.location.search);
  const filters = urlParams;
  filters.forEach((value, key) => {
    value = value.split(",");
    if ($(`input.filters[name="${key}"]`).attr('type') === 'checkbox' || $(`input.filters[name="${key}"]`).attr('type') === 'radio') {
      value.forEach(val => {
        $(`input.filters[name="${key}"][value="${val}"]`).prop('checked', true);
      });
    } else if ($(`input.filters[name="${key}"]`).attr('type') === 'range') {
      value.forEach(val => {
        $(`input.filters[name="${key}"]`).val(val);
      });
    } else {
      value.forEach(val => {
        $(`input.filters[name="${key}"] , select.filters[name="${key}"]`).val(val);
      });
    }
  });

  $('input.filters:checked').each(function () {
    if ($(this).is(':checked') || $(this).val()) {
      $(this).closest('label').addClass('active');
    }
  });

}

function edit_current_url(obj) {
  let str = [];
  let names = [];
  for (let key in obj) {
    if (key === 'csrf') continue;
    if (obj[key] instanceof Object) {
      for (let subKey in obj[key]) {
        if (obj[key][subKey]) {
          str.push(encodeURIComponent(key) + '=' + encodeURIComponent(obj[key][subKey]));
        }
      }
    } else {
      if (obj[key]) {
        str.push(encodeURIComponent(key) + '=' + encodeURIComponent(obj[key]));
      }
    }
  }

  let filters_input = $(`select.filters , input.filters:checked , input.filters[type=range]`) ?? null;
  let filters = [];
  filters_input.each(function () {
    if ($(this).val() == "") {
      return true;
    }
    if ($(this).attr("id") == "maxRange" || $(this).attr("id") == "minRange") {
      if ($(this).attr("id") == "maxRange") {
        label_string = ``;
      } else {
        label_string = ``;
      }
    } else {
      label_string = $(`label[for=${$(this).attr("id")}]`).contents().filter(function () {
        return this.nodeType === 3;
      }).text().trim().replaceAll(" ", "-");
    }
    filters.push(label_string);
  });
  filter_names = filters.join('&');
  queryString = filter_names + "&" + str.join('&');
  queryString = queryString.replace(/&&/g, '&').replace(/&&/g, '&').replace(/&&/g, '&').replace(/&&/g, '&');
  let newUrl = `${window.location.protocol}//${window.location.host}${window.location.pathname}?${queryString}`;
  history.pushState({ path: newUrl }, '', newUrl);
}