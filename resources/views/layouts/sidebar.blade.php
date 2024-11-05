<div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
    <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200">
        <ul class="pb-2 space-y-2">
            <li>
                <a href="{{ route('dashboard.index') }}"
                    class="{{ ($activeMenu == 'dashboard') ? 'bg-yellow-200 text-yellow-900' : 'text-gray-900' }} active flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-yellow-100 active:bg-yellow-300 group">
                    <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3" sidebar-toggle-item>Dashboard</span>
                </a>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-yellow-100 active:bg-yellow-300"
                    aria-controls="dropdown-activities" data-collapse-toggle="dropdown-activities">
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path
                            d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z">
                        </path>
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Activities</span>
                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <ul id="dropdown-activities" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ route('event.index') }}"
                            class="{{ ($activeMenu == 'event') ? 'bg-yellow-200 text-yellow-900' : 'text-gray-900' }} text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-yellow-100 pl-11">Events</a>
                    </li>
                    <li>
                        <a href="{{ route('goal.index') }}"
                            class="{{ ($activeMenu == 'goal') ? 'bg-yellow-200 text-yellow-900' : 'text-gray-900' }} flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-yellow-100 active:bg-yellow-300">Goals
                            Project</a>
                    </li>
                </ul>
            </li>
            <li>
                <button type="button"
                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-yellow-100 active:bg-yellow-300"
                    aria-controls="dropdown-employees" data-collapse-toggle="dropdown-employees">
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M.99 5.24A2.25 2.25 0 013.25 3h13.5A2.25 2.25 0 0119 5.25l.01 9.5A2.25 2.25 0 0116.76 17H3.26A2.267 2.267 0 011 14.74l-.01-9.5zm8.26 9.52v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75v.615c0 .414.336.75.75.75h5.373a.75.75 0 00.627-.74zm1.5 0a.75.75 0 00.627.74h5.373a.75.75 0 00.75-.75v-.615a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75v.625zm6.75-3.63v-.625a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75v.625c0 .414.336.75.75.75h5.25a.75.75 0 00.75-.75zm-8.25 0v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75v.625c0 .414.336.75.75.75H8.5a.75.75 0 00.75-.75zM17.5 7.5v-.625a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75V7.5c0 .414.336.75.75.75h5.25a.75.75 0 00.75-.75zm-8.25 0v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75V7.5c0 .414.336.75.75.75H8.5a.75.75 0 00.75-.75z">
                        </path>
                    </svg>
                    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Employee Services</span>
                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <ul id="dropdown-employees" class="hidden space-y-2 py-2 ">
                    <li>
                        <a href="{{ route('role.index') }}"
                            class="{{ ($activeMenu == 'role') ? 'bg-yellow-200 text-yellow-900' : 'text-gray-900' }} text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-yellow-100 pl-11">Roles</a>
                    </li>
                    <li>
                        <a href="{{ route('employee.index') }}"
                            class="{{ ($activeMenu == 'employee') ? 'bg-yellow-200 text-yellow-900' : 'text-gray-900' }} text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-yellow-100 active:bg-yellow-300 transition duration-75 pl-11">Employees</a>
                    </li>
                    <li>
                        <a href="{{ route('permission.index') }}"
                            class="{{ ($activeMenu == 'permission') ? 'bg-yellow-200 text-yellow-900' : 'text-gray-900' }} text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-yellow-100 active:bg-yellow-300 transition duration-75 pl-11">Permissions</a>
                    </li>
                    <li>
                        <a href="{{ route('time-off.index') }}"
                            class="{{ ($activeMenu == 'time-off') ? 'bg-yellow-200 text-yellow-900' : 'text-gray-900' }}text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-yellow-100 active:bg-yellow-300 transition duration-75 pl-11">Time Off</a>
                    </li>
                    <li>
                        <a href="#"
                            class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-yellow-100 active:bg-yellow-300 transition duration-75 pl-11">Absences</a>
                    </li>
                    <li>
                        <a href="#"
                            class="text-base text-gray-900 rounded-lg flex items-center p-2 group hover:bg-yellow-100 active:bg-yellow-300 transition duration-75 pl-11">Reports</a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="pt-2 space-y-2">
            <a href="#"
                class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg hover:bg-yellow-100 active:bg-yellow-300 group">
                <svg class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M8.34 1.804A1 1 0 019.32 1h1.36a1 1 0 01.98.804l.295 1.473c.497.144.971.342 1.416.587l1.25-.834a1 1 0 011.262.125l.962.962a1 1 0 01.125 1.262l-.834 1.25c.245.445.443.919.587 1.416l1.473.294a1 1 0 01.804.98v1.361a1 1 0 01-.804.98l-1.473.295a6.95 6.95 0 01-.587 1.416l.834 1.25a1 1 0 01-.125 1.262l-.962.962a1 1 0 01-1.262.125l-1.25-.834a6.953 6.953 0 01-1.416.587l-.294 1.473a1 1 0 01-.98.804H9.32a1 1 0 01-.98-.804l-.295-1.473a6.957 6.957 0 01-1.416-.587l-1.25.834a1 1 0 01-1.262-.125l-.962-.962a1 1 0 01-.125-1.262l.834-1.25a6.957 6.957 0 01-.587-1.416l-1.473-.294A1 1 0 011 10.68V9.32a1 1 0 01.804-.98l1.473-.295c.144-.497.342-.971.587-1.416l-.834-1.25a1 1 0 01.125-1.262l.962-.962A1 1 0 015.38 3.03l1.25.834a6.957 6.957 0 011.416-.587l.294-1.473zM13 10a3 3 0 11-6 0 3 3 0 016 0z">
                    </path>
                </svg>
                <span class="ml-3" sidebar-toggle-item>Settings</span>
            </a>
        </div>
    </div>
</div>