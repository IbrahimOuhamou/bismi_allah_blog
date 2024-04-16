#بسم الله الرحمن الرحيم
#la ilaha illa Allah mohammed rassoul Allah
from django.shortcuts import render, HttpResponse, get_object_or_404
from .models import bismi_allah_users, bismi_allah_blogs

def bismi_allah(request):
    return HttpResponse("bismi Allah")

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

def account(request):
    return HttpResponse("bismi Allah")

def login(request):
    return HttpResponse("bismi Allah")

def register(request):
    if 'POST' != request.method or not request.POST:
        render(request, "register_form.html")
    return HttpResponse("bismi Allah")

