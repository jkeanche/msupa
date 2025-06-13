@extends('layouts.app')

@section('title', 'User Details')

@section('breadcrumb')
<nav class="py-3 px-5">
    <ol class="flex flex-wrap text-sm">
        <li class="flex items-center">
            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-indigo-600">Dashboard</a>
            <svg class="h-4 w-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>
        <li class="flex items-center">
            <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:text-indigo-600">Users</a>
            <svg class="h-4 w-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </li>
        <li class="text-indigo-600 font-medium" aria-current="page">View User</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="flex justify-between items-center px-6 py-5 border-b border-gray-200">
            <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900">User Information</h3>
                <p class="mt-1 text-sm text-gray-500">
                    Detailed information about the user.
                </p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
            <div class="flex items-center">
                <div class="flex-shrink-0 h-16 w-16 rounded-full bg-indigo-100 flex items-center justify-center">
                    <svg class="h-10 w-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-500">
                        Member since {{ $user->created_at->format('M d, Y') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="p-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div class="col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $user->email }}</dd>
                </div>

                <div class="col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Role</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        @if(isset($user->role))
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                {{ $user->role }}
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                No Role
                            </span>
                        @endif
                    </dd>
                </div>

                <div class="col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $user->updated_at->format('M d, Y H:i') }}</dd>
                </div>

                <div class="col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        @if($user->is_active)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Inactive
                            </span>
                        @endif
                    </dd>
                </div>
            </dl>

            @if(count($user->permissions ?? []) > 0)
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900">Permissions</h3>
                <div class="mt-2 border-t border-gray-200 pt-4">
                    <div class="flex flex-wrap">
                        @foreach($user->permissions as $permission)
                            <span class="mr-2 mb-2 px-3 py-1 text-xs rounded-md bg-gray-100 text-gray-800">
                                {{ $permission->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <div class="mt-8 flex justify-end">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Back to List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection