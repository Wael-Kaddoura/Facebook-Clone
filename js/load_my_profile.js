async function getPageStatsAPI() {
  try {
    result = await $.get(
      "php/APIs/get_page_stats.php",
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

async function getUserDataAPI() {
  try {
    result = await $.get(
      "php/APIs/get_my_profile_data.php",
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
      "php/APIs/get_notifications.php",
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

async function getFriendRequestsAPI() {
  try {
    result = await $.get(
      "php/APIs/get_friend_requests.php",
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

async function getPendingFriendsAPI() {
  try {
    result = await $.get(
      "php/APIs/get_pending_friends.php",
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

async function getFriendsAPI() {
  try {
    result = await $.get(
      "php/APIs/get_friends.php",
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

async function cancelSentFriendRequestAPI(reciever_id) {
  try {
    result = await $.post("php/APIs/cancel_sent_friend_request.php", {
      reciever_id: reciever_id,
    });
  } catch (error) {
    console.log(error);
  }
}

async function acceptFriendRequestAPI(sender_id) {
  try {
    result = await $.post("php/APIs/accept_friend_request.php", {
      sender_id: sender_id,
    });
  } catch (error) {
    console.log(error);
  }
}

async function declineFriendRequestAPI(sender_id) {
  try {
    result = await $.post("php/APIs/decline_friend_request.php", {
      sender_id: sender_id,
    });
  } catch (error) {
    console.log(error);
  }
}

async function removeFriendAPI(removed_friend_id) {
  try {
    result = await $.post("php/APIs/remove_friend.php", {
      removed_friend_id: removed_friend_id,
    });
  } catch (error) {
    console.log(error);
  }
}

async function blockFriendAPI(blocked_user_id) {
  try {
    result = await $.post("php/APIs/block_user.php", {
      blocked_user_id: blocked_user_id,
    });
  } catch (error) {
    console.log(error);
  }
}

async function getUserData() {
  let user_data = JSON.parse(await getUserDataAPI());
  $("#my_name").text(user_data["name"]);
  $("#my_gender").text(user_data["gender"]);
}

async function getFriends() {
  let frnds_data = JSON.parse(await getFriendsAPI());
  let frnds_count = frnds_data["count"];
  let frnds_list = frnds_data["friends_list"];

  $("#frnds_counter").text(frnds_count);

  $("#frnds_container").empty();

  for (const frnd_id in frnds_list) {
    let frnd = `
      <li id = "frnd_${frnd_id}">
      <div class="nearly-pepls">
          <div class="pepl-info">
              <h4>
                  <a href="time-line.html" title="">${frnds_list[frnd_id]["name"]}</a>
              </h4>
              <span>${frnds_list[frnd_id]["gender"]}</span>
              <a href="#" value = ${frnd_id} title="Unfriend"
                  class="add-butn more-action unfriend_btn btn btn-outline-warning">Unfried</a>
  
              <a href="#" value = ${frnd_id} title="Block"
                  class="add-butn  block_btn btn btn-outline-danger">Block</a>
          </div>
      </div>
  </li>
                  `;
    $("#frnds_container").append(frnd);
  }

  $(".unfriend_btn").click(async function (e) {
    e.preventDefault();

    let removed_friend_id = $(this).attr("value");
    await removeFriendAPI(removed_friend_id);
    $("#frnd_" + removed_friend_id).remove();

    getFriends();
  });

  $(".block_btn").click(async function (e) {
    e.preventDefault();

    let blocked_user_id = $(this).attr("value");
    $("#frnd_" + blocked_user_id).remove();
    blockFriendAPI(blocked_user_id);

    getFriends();
  });
}

async function getFriendRequests() {
  let frnd_reqs_data = JSON.parse(await getFriendRequestsAPI());
  let frnd_reqs_count = frnd_reqs_data["count"];
  let frnd_reqs_list = frnd_reqs_data["requests_list"];

  $("#frnd_req_counter").text(frnd_reqs_count);

  $("#frnd_req_container").empty();

  for (const req_id in frnd_reqs_list) {
    let req = `
    <li id = "req_${req_id}">
    <div class="nearly-pepls">
        <div class="pepl-info">
            <h4>
                <a href="time-line.html" title="">${frnd_reqs_list[req_id]["sender_name"]}</a>
            </h4>
            <span>${frnd_reqs_list[req_id]["gender"]}</span>
            <a href="#" value = ${req_id} title="Accept Request"
                class="add-butn more-action accept_req_btn btn btn-outline-success">Accept</a>

            <a href="#" value = ${req_id} title="Decline Request"
                class="add-butn  decline_req_btn btn btn-outline-danger">Decline</a>
        </div>
    </div>
</li>
`;
    $("#frnd_req_container").append(req);
  }

  $(".accept_req_btn").click(async function (e) {
    e.preventDefault();

    let sender_id = $(this).attr("value");
    await acceptFriendRequestAPI(sender_id);
    $("#req_" + sender_id).remove();
    getFriends();
    getNotifications();
    getFriendRequests();
  });

  $(".decline_req_btn").click(async function (e) {
    e.preventDefault();

    let sender_id = $(this).attr("value");
    await declineFriendRequestAPI(sender_id);
    $("#req_" + sender_id).remove();
    getNotifications();
    getFriendRequests();
  });
}

async function getPendingFriends() {
  let pending_frnds_data = JSON.parse(await getPendingFriendsAPI());
  let pending_frnds_count = pending_frnds_data["count"];
  let pending_frnds_list = pending_frnds_data["list"];

  $("#pending_frds_counter").text(pending_frnds_count);

  $("#pending_frds_container").empty();

  for (const pending_frnd_id in pending_frnds_list) {
    let pending_frnd = `
    <li id="pending_frnd_${pending_frnd_id}">
    <div class="nearly-pepls">
      <div class="pepl-info">
        <h4>
          <a href="time-line.html" title="">${pending_frnds_list[pending_frnd_id]["reciever_name"]}</a>
        </h4>
        <span>${pending_frnds_list[pending_frnd_id]["gender"]}</span>
        <a href="#" value=${pending_frnd_id} title="Accept Request"
          class="add-butn cancel_req_btn btn btn-outline-danger">Cancel Request</a>
      </div>
    </div>
  </li>

`;
    $("#pending_frds_container").append(pending_frnd);
  }

  $(".cancel_req_btn").click(async function (e) {
    e.preventDefault();

    let reciever_id = $(this).attr("value");
    await cancelSentFriendRequestAPI(reciever_id);
    $("#pending_frnd_" + reciever_id).remove();

    getPendingFriends();
  });
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
    getUserData();

    getNotifications();
    getFriendRequests();
    getFriends();
    getPendingFriends();

    setInterval(() => {
      getNotifications();
      getFriendRequests();
      getFriends();
      getPendingFriends();
    }, 5000);
  } else {
    loadLoggedOutVersion();
  }
}

$(document).ready(function () {
  loadPage();
});
