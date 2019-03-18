    <div class="container">
        <div class="col-lg-6 col-lg-offset-3 join-form">
            <h2>Hotel Jeju</h2>
            <div class="panel"></div>
            <form class="form-horizontal join-form" id="joinForm" method="post" action="/member/addUser">
                <input type="text" class="form-control" name="id" placeholder="아이디(이메일)">
                <input type="text" class="form-control" name="name" placeholder="이름">
                <input type="password" class="form-control pw" name="pw" placeholder="비밀번호">
                <input type="password" class="form-control repw" name="repw" placeholder="비밀번호 확인">
                <input type="submit" value="회원가입" class="btn btn-success btn-block">
            </form>
        </div>
    </div>

    <script>
        window.dd = console.log.bind(console);

        $(function() {
            $(joinForm).off().on({
                submit : function(e) {
                    if($(".pw").val() != $(".repw").val()) {
                        alert("비밀번호와 비밀번호 확인이 일치하지 않습니다.");
                        e.preventDefault();
                    };
                },
            });
        });
    </script>
</body>
</html>