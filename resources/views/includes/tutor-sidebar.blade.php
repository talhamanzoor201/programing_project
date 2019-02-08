<aside class="col-lg-3 column border-right">
    <div class="widget">
        <div class="tree_widget-sec">
            <ul>
                <li class="" id="tutor-nav-profile">
                    <a href="{{url('/tutor')}}"
                       title=""><i class="la la-file-text"></i> Profile</a>
                </li>
                <li class="" id="tutor-nav-skills">
                    <a href="{{url('tutor/skills')}}"
                       title=""><i class="la la-briefcase"></i>Manage Skills</a>
                </li>
                <li class="" id="tutor-nav-request">
                    <a href="{{url('/tutor/requests')}}"
                       title=""><i class="la la-money"></i>Hire Request</a>
                </li>
                <li class="" id="tutor-nav-student">
                    <a href="{{url('/tutor/students')}}"
                       title=""><i class="la la-user"></i>Students</a>
                </li>
                <li class=""  id="tutor-nav-report">
                    <a href="{{url('/tutor/reports')}}"
                       title=""><i class="la la-file-text"></i>Student Reports History</a>
                </li>
                <li class="" id="tutor-nav-payment">
                    <a href="{{url('tutor/payments')}}"
                       title=""><i class="la la-money"></i>Payments</a>
                </li>
                <li class="" id="tutor-nav-inbox">
                    <a href="{{url('/tutor/inbox')}}"
                       title=""><i class="la la-flash"></i>Inbox</a>
                </li>
                <li class="" id="tutor-nav-password">
                    <a href="{{url('tutor/password')}}"
                       title=""><i class="la la-lock"></i>Change Password</a>
                </li>
                <li><a href="{{url('tutor/logout')}}"
                       title=""><i class="la la-unlink"></i>Logout</a></li>
            </ul>
        </div>
    </div>
    @if(isset($progress))
        <div class="widget">
            <div class="skill-perc">
                <h3>Profile Completed </h3>
                <p>Complete your profile to 75% to get started.</p>
                <div class="skills-bar">
                    <span>{{$progress}}%</span>
                    <div class="second circle" data-size="155" data-thickness="60">
                    </div>
                </div>
            </div>
        </div>
    @endif
</aside>