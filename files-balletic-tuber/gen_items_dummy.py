for i in range(50):
    print("""echo "this is dummy item num {0}" > dummy{0}-title.txt
echo "this is dummy item num {0} and this is a description" > dummy{0}-desc.txt
echo "this is dummy item num {0} and this is a description (another line)" >> dummy{0}-desc.txt
cp a-pic.jpg dummy{0}-pic.jpg
""".format(str(i)));

