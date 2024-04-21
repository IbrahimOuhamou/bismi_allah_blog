#بسم الله الرحمن الرحيم
#la ilaha illa Allah mohammed rassoul Allah

from django.http import HttpResponse, HttpResponseRedirect
from django.shortcuts import render, get_object_or_404
from django.urls import reverse

import secrets, hashlib

from .models import bismi_allah_users, bismi_allah_blogs

def bismi_allah(request):
    return render(request, "bismi_allah.html")

def users(request):
    bismi_allah_users_list = bismi_allah_users.objects.all()
    context = {"bismi_allah_users_list": bismi_allah_users_list }
    return render(request, "users.html", context)

def user(request, user_id):
    bismi_allah_user = get_object_or_404(bismi_allah_users, pk=user_id)
    return render(request, "user.html", {"bismi_allah_user": bismi_allah_user})

def blogs(request):
    bismi_allah_blogs_list = bismi_allah_blogs.objects.all()
    return render(request, "blogs.html", {"bismi_allah_blogs_list": bismi_allah_blogs_list})

def blog(request, blog_id):
    #bismi_allah_blog = bismi_allah_blogs.objects.get(pk=blog_id)
    bismi_allah_blog = get_object_or_404(bismi_allah_blogs, pk=blog_id)
    return render(request, "blog.html", {"bismi_allah_blog": bismi_allah_blog, "bismi_allah_user": bismi_allah_blog.user})

def blog_create(request):
    return HttpResponse("bismi Allah")

def blog_edit(request):
    return HttpResponse("bismi Allah")

def account(request):
    return HttpResponse("bismi Allah account")

def login(request):
    if 'POST' != request.method or not request.POST:
        return render(request, "login_form.html")

    bismi_allah_user = bismi_allah_users.objects.filter(name=request.POST["bismi_allah_name"])[0]

    if not bismi_allah_user:
        return render(request, "login_form.html", {"error_message": "sub7an Allah bismi_allah_name '" + request.POST["bismi_allah_name"] + "' is not set"})

    if bismi_allah_user.password_hash != hashlib.sha256((request.POST["bismi_allah_password"]+bismi_allah_user.password_salt).encode("utf-8")).hexdigest():
        return render(request, "login_form.html", {"error_message": "sub7an Allah password was incorrect"})

    request.session["account_name"] = bismi_allah_user.name
    request.session["account_email"] = bismi_allah_user.email
    return HttpResponseRedirect(reverse("bismi_allah"))

def register(request):
    if 'POST' != request.method or not request.POST:
        return render(request, "register_form.html")
    #will by the will of Allah check if there is a user with that account
    bismi_allah_user = bismi_allah_users.objects.filter(name=request.POST["bismi_allah_name"])
    if bismi_allah_user:
        error_message = "sub7an Allah bismi_allah_name '" + bismi_allah_user[0].name + "' already set"
        return render(request, "register_form.html", {"error_message": error_message})

    salt = secrets.token_bytes(6).hex()
    bismi_allah_user = bismi_allah_users(name=request.POST["bismi_allah_name"], email=request.POST["bismi_allah_email"], password_salt=salt, password_hash=hashlib.sha256((request.POST["bismi_allah_password"]+salt).encode("utf-8")).hexdigest())
    bismi_allah_user.save()

    #request.session["account_name"] = bismi_allah_user.name
    #request.session["account_email"] = bismi_allah_user.email
    return HttpResponseRedirect(reverse("login"))

