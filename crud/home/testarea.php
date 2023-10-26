<style>
.chat-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
    position: relative;
    z-index: 10;
    gap: 15px;
}

.chatArea-body {
    background-color: #fff;
}

.up-container {
    width: 90%;
    /* height: 20%; */
    display: flex;
    align-items: center;
    margin-top: 25px;
    justify-content: center;
}

.down-container {
    width: 90%;
    height: 80%;
}

.inputSearchUser {
    width: 100%;
    display: flex;
    flex-grow: 1;
    gap: 0.1em;
}

.searchBtn {
    width: 20%;
    padding: 0.8em;
    border-radius: 5px;
    background-color: #381DDB;
    color: #fff;
    cursor: pointer;

}

.searchText {
    width: 80%;
    padding: 0.8em;
    border-radius: 5px;
}


.search-each-user-container {
    display: flex;
    flex-direction: column;
    gap: 0.1em;
}

.each-user-search {
    width: 100%;
    border: 1px solid red;
    /* height: 60px; */
    border-radius: 3px;
}

.each-user-search-child {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: start;
    gap: 1em;
}

.img-user-search {

    margin-left: 0.5em;
}

.down {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
    height: 100%;
    /* margin: 2% 0; */
    /* padding: 15px 0; */
}

.content {
    width: 90%;
    height: 75%;
    overflow-y: scroll;

    background: #eaf5f9;
}

.chatArea-body {
    height: 100%;
}

.exit {
    position: absolute;
    top: 0;
    right: 0;
    padding: 0.4em;
    cursor: pointer
}

.exit i {
    font-size: 15px;
    color: #666;
}

.typing {
    width: 100%;
    height: 25%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5em;
}

.typing-input {
    width: 80%;
}

.typing-input input {
    padding: 1em 0.5em;
    width: 100%;
    border-radius: 5px;

}

.typing-send {
    width: 20%;
}

.typing-send-btn {
    padding: 1em 0;
    width: 100%;
    border-radius: 5px;
    background-color: #381DDB;
    color: #fff;
    cursor: pointer;
}
</style>

<div class="chatArea-body">
    <div class="chat-container">
        <div class='exit' onclick='toggleOpenChat()'><i class="fas fa-times"></i></div>
        <div class="up-container">
            <div class="inputSearchUser">
                <input type="text" placeholder="Search..." class="searchText" class="form-control">
                <button class="searchBtn">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        <div class="down-container">
            <div class="down">
                <div class="content">
                    <ul class="search-each-user-container">
                        <li class="each-user-search">
                            <a href="/">
                                <div class="each-user-search-child">
                                    <div class='img-user-search'
                                        style="background: url(/comp1841/crud/user/uploads/cho-ray.jpg) no-repeat center center; width: 50px; height: 50px; border-radius: 50%;"
                                        alt="">

                                    </div>
                                    <h3>Name</h3>
                                </div>
                                <div>
                            </a>
                        </li>
                        <li class="each-user-search">
                            <a href="/">
                                <div class="each-user-search-child">
                                    <div class='img-user-search'
                                        style="background: url(/comp1841/crud/user/uploads/cho-ray.jpg) no-repeat center center; width: 50px; height: 50px; border-radius: 50%;"
                                        alt="">

                                    </div>
                                    <h3>Name</h3>
                                </div>
                                <div>
                            </a>
                        </li>
                        <li class="each-user-search">
                            <a href="/">
                                <div class="each-user-search-child">
                                    <div class='img-user-search'
                                        style="background: url(/comp1841/crud/user/uploads/cho-ray.jpg) no-repeat center center; width: 50px; height: 50px; border-radius: 50%;"
                                        alt="">

                                    </div>
                                    <h3>Name</h3>
                                </div>
                                <div>
                            </a>
                        </li>
                        <li class="each-user-search">
                            <a href="/">
                                <div class="each-user-search-child">
                                    <div class='img-user-search'
                                        style="background: url(/comp1841/crud/user/uploads/cho-ray.jpg) no-repeat center center; width: 50px; height: 50px; border-radius: 50%;"
                                        alt="">

                                    </div>
                                    <h3>Name</h3>
                                </div>
                                <div>
                            </a>
                        </li>
                        <li class="each-user-search">
                            <a href="/">
                                <div class="each-user-search-child">
                                    <div class='img-user-search'
                                        style="background: url(/comp1841/crud/user/uploads/cho-ray.jpg) no-repeat center center; width: 50px; height: 50px; border-radius: 50%;"
                                        alt="">

                                    </div>
                                    <h3>Name</h3>
                                </div>
                                <div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="typing">
                    <div class="typing-input">
                        <input />
                    </div>
                    <div class="typing-send">
                        <button class="typing-send-btn">Send</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
    function toggleOpenChat() {
        let areaText = document.getElementById('chatArea');
        let btnChat = document.getElementsByClassName('btnChat');
        if (areaText.style.display === "none") {
            areaText.style.display = "block";
        } else {
            areaText.style.display = "none";
        }
    }
    </script>