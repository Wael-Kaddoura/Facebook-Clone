async function getPageStatsAPI() {
  try {
    result = await $.get(
      "http://localhost/Wael_Kaddoura_Implement_Facebook/php/APIs/get_page_stats.php",
      {},
      function (data, textStatus, jqXHR) {
        return data;
      }
    );
    return result;
  } catch (error) {
    console.log(error);
  }
}

async function getNotificationsAPI() {
  try {
    result = await $.get(
      "http://localhost/Wael_Kaddoura_Implement_Facebook/php/APIs/get_notifications.php",
      {},
      function (data, textStatus, jqXHR) {
        return data;
      }
    );
    return result;
  } catch (error) {
    console.log(error);
  }
}

async function getSearchResultsAPI(srch_term) {
  try {
    result = await $.get(
      "http://localhost/Wael_Kaddoura_Implement_Facebook/php/APIs/search_users.php",
      { srch_term: srch_term },
      function (data, textStatus, jqXHR) {
        return data;
      }
    );
    return result;
  } catch (error) {
    console.log(error);
  }
}

async function sendFriendRequestAPI(reciever_id) {
  try {
    result = await $.post(
      "http://localhost/Wael_Kaddoura_Implement_Facebook/php/APIs/send_friend_request.php",
      { reciever_id: reciever_id }
    );
  } catch (error) {
    console.log(error);
  }
}

async function blockUserAPI(blocked_user_id) {
  try {
    result = await $.post(
      "http://localhost/Wael_Kaddoura_Implement_Facebook/php/APIs/block_user.php",
      { blocked_user_id: blocked_user_id }
    );
  } catch (error) {
    console.log(error);
  }
}

async function getNotifications() {
  let notifications_data = JSON.parse(await getNotificationsAPI());
  let notifications_count = notifications_data["count"];
  let notifications_list = notifications_data["notifications_list"];

  $(".notification_counter").text(notifications_count);

  $("#notifications_container").empty();
  for (const not_id in notifications_list) {
    let notification = `
    <li id = "not_${not_id}">
    <a href="#" title="">
      <i>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
          fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
          <path
            d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
        </svg>
      </i>


      <div class="mesg-meta">
        <h6>${notifications_list[not_id]["sender_name"]}</h6>
        <span>${notifications_list[not_id]["notification_body"]}</span>

      </div>


    </a>
  </li>
`;
    $("#notifications_container").append(notification);
  }
}

async function getSearchResults(srch_term) {
  let search_results = JSON.parse(await getSearchResultsAPI(srch_term));
  $("#srch_results_container").empty();
  for (const result_id in search_results) {
    let result_row = `
    <div class="row mb-4" id = "result_${result_id}">
      <div class="col-4 col-sm-3 align-self-center">${search_results[result_id]["name"]}</div>
      <div class="col-6 col-sm-2 col-md-3 align-self-center">${search_results[result_id]["gender"]}</div>
      <div class="col-6 col-sm-4 col-md-3 align-self-center">
          <button  value = ${result_id} class="btn btn-outline-primary text-center send_request_btn">
              Send Friend Request
          </button>
      </div>
      <div class="col-6 col-sm-3 align-self-center">
          <button  value= ${result_id} class="btn btn-outline-danger block_user_btn">
              Block
          </button>
      </div>
      </div>
      `;
    $("#srch_results_container").append(result_row);
  }

  $(".send_request_btn").click(function (e) {
    e.preventDefault();
    let reciever_id = $(this).val();
    sendFriendRequestAPI(reciever_id);
    $("#result_" + reciever_id).remove();
  });

  $(".block_user_btn").click(function (e) {
    e.preventDefault();

    let blocked_user_id = $(this).val();
    $("#result_" + blocked_user_id).remove();
    blockUserAPI(blocked_user_id);
  });
}

async function loadLoggedInVersion(page_stats) {
  let action = `<a href="php/logout.php"><button class="btn btn-outline-danger">Log out</button></a>`;
  $("#user_action").append(action);

  let username = page_stats["username"];
  $("#username").text(username);
}

async function loadLoggedOutVersion() {
  let action = `<a href="login.php" class="btn btn-outline-success mt-1">Log in</a>`;
  $("#user_action").append(action);
}

async function loadPage() {
  let page_stats = JSON.parse(await getPageStatsAPI());

  if (page_stats["is_logedin"]) {
    loadLoggedInVersion(page_stats);
    getNotifications();

    setInterval(() => {
      getNotifications();
    }, 5000);
  } else {
    loadLoggedOutVersion();
  }
}

$(document).ready(function () {
  loadPage();
});

$("#srch_bar").keyup(function (e) {
  let srch_term = $(this).val();

  if (srch_term != "") {
    $("#main_container").attr("class", "central-meta");
    getSearchResults(srch_term);
  } else {
    $("#main_container").attr("class", "");
    $("#srch_results_container").empty();
  }
});

$("#srch_btn").keyup(function (e) {
  let srch_term = $(srch_bar).val();
  console.log(srch_term);
  if (srch_term != "") {
    $("#main_container").attr("class", "central-meta");
    getSearchResults(srch_term);
  } else {
    $("#main_container").attr("class", "");
    $("#srch_results_container").empty();
  }
});
