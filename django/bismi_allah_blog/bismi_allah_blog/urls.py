#بسم الله الرحمن الرحيم
#la ilaha illa Allah mohammed rassoul Allah
"""
URL configuration for bismi_allah_blog project.

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/4.2/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.contrib import admin
from django.urls import path
from . import views

urlpatterns = [
    path('', views.bismi_allah, name="bismi_allah"),
    path('users', views.users, name="users"),
    path('bismi_allah_user/<int:user_id>', views.user, name="user"),
    path('blogs', views.blogs, name="blogs"),
    path('bismi_allah_blog/<int:blog_id>', views.blog, name="blog"),
    path('bismi_allah_blog/create', views.blog_create, name="blog_create"),
    path('bismi_allah_blog/edit', views.blog_edit, name="blog_edit"),
    path('account/', views.account, name="account"),
    path('account/login', views.login, name="login"),
    path('account/register', views.register, name="register"),
    path('admin/', admin.site.urls),
]
