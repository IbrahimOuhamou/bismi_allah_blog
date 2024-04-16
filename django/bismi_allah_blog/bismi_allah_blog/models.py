#بسم الله الرحمن الرحيم
#la ilaha illa Allah mohammed rassoul Allah

from django.db import models

class bismi_allah_users(models.Model):
    name = models.CharField(max_length=32)
    email = models.EmailField(max_length=254)
    password_salt = models.CharField(max_length=12)
    password_hash = models.CharField(max_length=226)

    def __str__(self):
        return self.name

class bismi_allah_blogs(models.Model):
    title = models.CharField(max_length=256)
    text = models.TextField()
    creation_time = models.DateTimeField(auto_now=True)
    user = models.ForeignKey(bismi_allah_users, on_delete=models.CASCADE)

    def __str__(self):
        return self.title

