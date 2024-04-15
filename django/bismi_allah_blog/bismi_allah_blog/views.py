#بسم الله الرحمن الرحيم
#la ilaha illa Allah mohammed rassoul Allah
from django.shortcuts import render, HttpResponse
from .models import bismi_allah_users, bismi_allah_blogs

def bismi_allah(request):
    return HttpResponse("bismi Allah")

def users(request):
    bismi_allah_users_list = bismi_allah_users.objects.all()
    output = ", ".join([user.name for user in bismi_allah_users_list])
    return HttpResponse(output)

def user(request, user_id):
    return HttpResponse("bismi Allah" + "<br>" + str(user_id))

def blogs(request):
    return HttpResponse("bismi Allah" + "<br>" + str(blog_id))

def blog(request, blog_id):
    return HttpResponse("bismi Allah")

def account(request):
    return HttpResponse("bismi Allah")

def login(request):
    return HttpResponse("bismi Allah")

def register(request):
    return HttpResponse("bismi Allah")

