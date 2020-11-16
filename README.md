# TimeCapsule

## Image Restoration and Sharing App

### Team members: 
	- D
	- E
	- G
	- T
	- M

TimeCapsule is a photo editing and social media application that seeks repair and enhance deteriorated images and give its users the platform to share their images with the world. 

Use NVIDIA's advanced image inpainting technology to inpaint and restore your pictures or touch them up with various filters and basic photo editing tools.

Then share your image to the WorldHub community. Join your favorite hubs and explore what other images of the past others have to share.

Visit us and register at http://tec2.hpc.temple.edu/~tue57166/4398/Project/index.html

or at http://cis-linux2.temple.edu/~tue57166/4398/Project/

Try out the inpainting application [here.](http://129.114.109.183:5000/)


## Features

- Inpainting Tool via NVIDIA
- Map API markers
- Photohub-app api and client are for a react based app that uses AWS cognito to handle user registration/login, dyanamo DB to store a user database, and an S3 bucket to store user-uploaded images.
- APK for installation of TimeCapsule on Android devices
	- Load the APK onto target device, it should install automatically.

## Incomplete features

- Android photo editing library integration
	- Can be built and tested on an Android emulator 
- Blur tool was never implemented
- Noise removal tool was never implemented

## Can be improved

- Google Maps marker integration
- Inpainting
	- Find alternative to Flask

## READMEs

- Each folder contains a readme on how to install and use the features
- In the case of TimeCapsule, it just needs to be hosted on a temple server (linux2 or tec2).

## License

See the [LICENSE](LICENSE) file for license rights and limitations (APACHE 2.0).
