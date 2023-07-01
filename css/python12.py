a=int(input("enter nu."))
b=int(input("enter nu2."))
try:
    c=a/b
    print(c)
except ZeroDivisionError:
    print("you can not divide by zero")

