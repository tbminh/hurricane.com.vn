@extends('home.profile_user.layout_profile')
@section('title', 'Đổi mật khẩu')
@section('content-profile-col-9')

        @if(session()->has('message'))
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Thay đổi mật khẩu thành công, vui lòng đăng nhập lại!',
                    showConfirmButton: 'true',
                    width: '600px',
                    height: '500px'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "logout";
                    } 
                    })

            </script>
        @endif  
        {{-- Xác nhận mật khẩu sai --}}
        @if(session()->has('message1'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Mật khẩu xác nhận không đúng!',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
        @endif
        {{-- Nhập sai mật khẩu cũ --}}
        @if(session()->has('message2'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Mật khẩu cũ không đúng!',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
        @endif

        

<div class="form-group col-md-10">
    <div class="tab-content">
        <div>
            <h1 style="text-align: center;"> Đổi mật khẩu</h1>
            <form action="{{ url('update-password/'.Auth::id()) }}" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="form-group">
                    <label for="">Mật khẩu cũ:</label>
                    <input type="password" name="inputPassOld" class="form-control" placeholder="Nhập mật khẩu cũ" required>
                </div>

                <div class="form-group">
                    <label for="">Mật khẩu mới:</label>
                    <input type="password" name="inputPassNew" class="form-control" placeholder="Nhập mật khẩu mới" required>
                </div>

                <div class="form-group">
                    <label for="">Xác nhận mật khẩu:</label>
                    <input type="password" name="inputPassComfirm" class="form-control" placeholder="Xác nhận mật khẩu" required>
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-danger">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>
    <!-- tab-content -->
</div> <!-- /form -->



<script>
    $('.form').find('input, textarea').on('keyup blur focus', function (e) {

        var $this = $(this),
            label = $this.prev('label');

        if (e.type === 'keyup') {
            if ($this.val() === '') {
                label.removeClass('active highlight');
            } else {
                label.addClass('active highlight');
            }
        } else if (e.type === 'blur') {
            if( $this.val() === '' ) {
                label.removeClass('active highlight');
            } else {
                label.removeClass('highlight');
            }
        } else if (e.type === 'focus') {

            if( $this.val() === '' ) {
                label.removeClass('highlight');
            }
            else if( $this.val() !== '' ) {
                label.addClass('highlight');
            }
        }

    });

    $('.tab a').on('click', function (e) {

        e.preventDefault();

        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');

        target = $(this).attr('href');

        $('.tab-content > div').not(target).hide();

        $(target).fadeIn(600);

    });

</script>

@endsection
