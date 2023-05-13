import sys
import numpy as np #pour calcul matriciel
from matplotlib import pyplot as plt
from skimage import exposure
from skimage.exposure import histogram
from skimage import io #input output
from skimage.filters import threshold_otsu
import matplotlib.cm as cm
result = sys.argv[1]
img=io.imread("images/"+result)

from skimage import color
img_Gray = color.rgb2gray(img)
io.imsave('./images/new_img/'+result[:-4]+'_grey.jpg', img_Gray) 
from skimage.transform import resize
res = resize(img_Gray, (100, 100))
io.imsave('./images/new_img/'+result[:-4]+'_resized.jpg', res) 


r = np.histogram(res,256)[0]
cumsum = np.cumsum(res)
u=r
v=[i for i in range(len(r))]
x_cumsum=[i for i in range(len(cumsum))]
plt.bar(v,r)
#plt.show()
#--------------------------
from skimage import util
img_Gray_Inv = util.invert(img_Gray) # inverser les niveux de gris
#io.imshow(img_Gray_Inv)
#plt.show()
plt.imsave('./images/new_img/'+result[:-4]+'_Gray_Inv.jpg', img_Gray_Inv, cmap=cm.gray) 
#---------hsv
img_hsv = color.rgb2hsv(img) # convertir en niveaux de gris
#plt.imshow(img_hsv, cmap='gray')
#plt.show()
plt.imsave('./images/new_img/'+result[:-4]+'_hsv.jpg',img_hsv , cmap=cm.gray) 
#---------canal-------------
canal_h = img_hsv[:, :, 0] # faire soustraction de l'image h Teinte (H)
canal_s = img_hsv[:, :, 1] # faire soustraction de l'image s saturation (S)
canal_v = img_hsv[:, :, 2] # faire soustraction de l'image v luminance luminance (V) 
plt.imsave('./images/new_img/'+result[:-4]+'_canal_h.jpg',canal_h , cmap=cm.gray) 
plt.imsave('./images/new_img/'+result[:-4]+'_canal_s.jpg',canal_s , cmap=cm.gray) 
plt.imsave('./images/new_img/'+result[:-4]+'_canal_v.jpg',canal_v , cmap=cm.gray) 

#--------colors---------
l=['red','green','blue']
#for i,c in enumerate(l):
  #  plt.plot(exposure.histogram(img[:, :, i])[0],color=c)
#plt.show()
#-----colors rgb---------------
red=exposure.histogram(img[:, :, 0])[0]
green=exposure.histogram(img[:, :, 1])[0]
blue=exposure.histogram(img[:, :, 2])[0]
bande_rouge = img[:, :, 0] # faire soustraction de l'image rouge
bande_vert = img[:, :, 1] # faire soustraction de l'image vert
bande_bleu = img[:, :, 2] # faire soustraction de l'image bleu
plt.imsave('./images/new_img/'+result[:-4]+'_rouge.jpg', bande_rouge, cmap=cm.Reds_r) 
plt.imsave('./images/new_img/'+result[:-4]+'_vert.jpg', bande_vert, cmap=cm.Greens_r) 
plt.imsave('./images/new_img/'+result[:-4]+'_bleu.jpg', bande_bleu, cmap=cm.Blues_r) 

#---------th outso-------------
th=threshold_otsu(img_Gray)
#------------------
#--- seuillage-------
n,m=img_Gray.shape
image_binaire = np.zeros((n,m),dtype=np.uint8)
for i in range(n):
    for j in range(m):
        if img_Gray[i,j]>th:
            image_binaire[i,j]=1
v_seuil = np.histogram(image_binaire,256)[0]
plt.imsave('./images/new_img/'+result[:-4]+'_binaire.jpg', image_binaire, cmap=cm.gray) 

#-----end seuillage----------
#-------etirement-------------
g=255/(img.max()-img.min())
d=img.min()*255/(img.max()-img.min())
def t(x,g,d):
    return g*x+d
def Etirement(img):
    n,m,k=img.shape
    image_noveau = np.zeros((n,m),dtype=np.float64)
    for i in range(k):
        bande = img[:, :, i]
        g=255/(bande.max()-bande.min())
        d=(bande.min()*255)/(bande.max()-bande.min())
        image_noveau+=t(bande,g,d)
    return image_noveau
image_noveau=Etirement(img)
H_etirée,bins=np.histogram(image_noveau,bins=256)
plt.imsave('./images/new_img/'+result[:-4]+'_etiree.jpg', image_noveau, cmap=cm.gray) 


# end etirement------------------
#----------str---------------
def listToString(instr):
    emptystr=""
    for ele in instr: 
        emptystr += str(ele)+','
    return emptystr[:-1]
#---------convert-----------
u=listToString(r)
v=listToString(v)
cumsum=listToString(cumsum)
x_cumsum=listToString(x_cumsum)
red=listToString(red)
green=listToString(green)
blue=listToString(blue)
v_seuil=listToString(v_seuil)
H_etirée=listToString(H_etirée)
th=str(th)
#---------------
#canny
import cv2
import numpy as np
img_canny = cv2.Canny(img,100,200)

#sobel
img_gaussian = cv2.GaussianBlur(img_Gray,(3,3),0)
img_sobelx = cv2.Sobel(img_gaussian,cv2.CV_8U,1,0,ksize=5)
img_sobely = cv2.Sobel(img_gaussian,cv2.CV_8U,0,1,ksize=5)
img_sobel = img_sobelx + img_sobely

#prewitt
kernelx = np.array([[1,1,1],[0,0,0],[-1,-1,-1]])
kernely = np.array([[-1,0,1],[-1,0,1],[-1,0,1]])
img_prewittx = cv2.filter2D(img_gaussian, -1, kernelx)
img_prewitty = cv2.filter2D(img_gaussian, -1, kernely)
#cv2.imshow("Original Image", img)
#cv2.imshow("Canny", img_canny)
plt.imsave('./images/new_img/'+result[:-4]+'_canny.jpg', img_canny, cmap=cm.gray) 
#cv2.imshow("Sobel X", img_sobelx)
plt.imsave('./images/new_img/'+result[:-4]+'_sobelx.jpg', img_sobelx, cmap=cm.gray) 
#cv2.imshow("Sobel Y", img_sobely)
plt.imsave('./images/new_img/'+result[:-4]+'_sobely.jpg', img_sobely, cmap=cm.gray) 
#cv2.imshow("Sobel", img_sobel)
plt.imsave('./images/new_img/'+result[:-4]+'_sobel.jpg', img_sobel, cmap=cm.gray) 
#cv2.imshow("Prewitt X", img_prewittx)
plt.imsave('./images/new_img/'+result[:-4]+'_prewittx.jpg', img_prewittx, cmap=cm.gray) 
#cv2.imshow("Prewitt Y", img_prewitty)
plt.imsave('./images/new_img/'+result[:-4]+'_prewitty.jpg', img_prewitty, cmap=cm.gray) 
#cv2.imshow("Prewitt", img_prewittx + img_prewitty)
plt.imsave('./images/new_img/'+result[:-4]+'_Prewitt.jpg', img_prewittx + img_prewitty, cmap=cm.gray) 
#cv2.waitKey(0)
#cv2.destroyAllWindows()
#---------------------------------
red_min = 190
red_max = 255
green_min = 180
green_max = 255
blue_min = 160
blue_max = 255
i=img
gray_low = np.array([blue_min,green_min,red_min])
gray_hi = np.array([blue_max,green_max,red_max])

mask = cv2.inRange(img,gray_low,gray_hi)

img[mask>0] = (212, 167, 140)

#cv2.imshow('img',img)
#cv2.waitKey(0)
#cv2.destroyAllWindows()
#----------SQL----------------
import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="root",
  database="users"
)
mycursor = mydb.cursor()

sql = "INSERT INTO uploadedimage  VALUES ('"+result+"','"+u+"','"+v+"','"+cumsum+"','"+x_cumsum+"','"+red+"','"+green+"','"+blue+"','"+th+"','"+v_seuil+"','"+H_etirée+"')"
mycursor.execute(sql)
mydb.commit()


print(mycursor.rowcount, "record inserted.")  













image=i
# convert to RGB
image = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
# reshape the image to a 2D array of pixels and 3 color values (RGB)
pixel_values = image.reshape((-1, 3))
# convert to float
pixel_values = np.float32(pixel_values)
print(pixel_values.shape)
# define stopping criteria
criteria = (cv2.TERM_CRITERIA_EPS + cv2.TERM_CRITERIA_MAX_ITER, 100, 0.2)
# number of clusters (K)
k = 3
_, labels, (centers) = cv2.kmeans(pixel_values, k, None, criteria, 10, cv2.KMEANS_RANDOM_CENTERS)
# convert back to 8 bit values
centers = np.uint8(centers)

# flatten the labels array
labels = labels.flatten()
# convert all pixels to the color of the centroids
segmented_image = centers[labels.flatten()]
# reshape back to the original image dimension
segmented_image = segmented_image.reshape(image.shape)
# show the image
#plt.imshow(segmented_image)
# save the image
plt.imsave('./images/new_img/'+result[:-4]+'_segmented.jpg', segmented_image) 

#plt.show()
# disable only the cluster number 2 (turn the pixel into black)
masked_image = np.copy(image)
# convert to the shape of a vector of pixel values
masked_image = masked_image.reshape((-1, 3))
# color (i.e cluster) to disable
cluster = 2
masked_image[labels == cluster] = [0, 0, 0]
# convert back to original shape
masked_image = masked_image.reshape(image.shape)
# show the image
#plt.imshow(masked_image)
# save the image
plt.imsave('./images/new_img/'+result[:-4]+'_masked.jpg', masked_image) 

#plt.show()

img=i
b,g,r = cv2.split(img)
rgb_img = cv2.merge([r,g,b])

gray = cv2.cvtColor(img,cv2.COLOR_BGR2GRAY)
ret, thresh = cv2.threshold(gray,0,255,cv2.THRESH_BINARY_INV+cv2.THRESH_OTSU)
#plt.subplot(121),plt.imshow(rgb_img)
#plt.title('Input Image'), plt.xticks([]), plt.yticks([])
#plt.subplot(122),plt.imshow(thresh, 'gray')
##plt.title("Otus's binary threshold"), plt.xticks([]), plt.yticks([])
#plt.show()
plt.imsave('./images/new_img/'+result[:-4]+'_rgb.jpg', rgb_img) 
plt.imsave('./images/new_img/'+result[:-4]+'_otus.jpg', thresh, cmap=cm.gray) 

