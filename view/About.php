<?php
// Start the session
session_start();

// Example: Set a username in the session (only for testing)
// $_SESSION['username'] = "JohnDoe";

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : "Guest";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./css/about.css">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../view/css/index.css">
</head>
<body>
    <!-- Header Section -->
    <header class="header">
    <div class="logo">
        <h1><a href="index.php">Crochet Learning</a></h1>
    </div>
    <nav class="navbar" aria-label="Main navigation">
        <a href="index.php" aria-current="page">Home</a>
        <a href="about.php">About</a>
        <a href="collection.php">Collection</a>
        <a href="course.php">Course</a>
        <a href="display_patterns.php">Pattern</a>
      
    </nav>
    <div class="user-actions">
        <a href="my-account.php" aria-label="My Account">
            <i class="fas fa-user-circle"></i>
        </a>
        <span id="username" class="username">
            <?php echo htmlspecialchars($username); ?>
        </span>
        <a href="<?php echo $isLoggedIn ? 'logout.php' : '../Login/login.php'; ?>" class="auth-btn">
            <?php echo $isLoggedIn ? 'Logout' : 'Login'; ?>
        </a>
    </div>
</header>

    <!-- About Section -->     
<section id="about" class="about">
    <div class="container">
        <h2>About Us</h2>
        <p>Welcome to Online Crochet 🧶🪡Learning! Our mission is to provide a cozy, creative space for crochet enthusiasts of all levels🧶🧵to learn, grow, 
            and connect. Whether you're a beginner just picking up a hook or a seasoned crocheter looking to refine your skills, we have 
            something for everyone ♥.</p>
        
            <div class="crochet-section">
                <div class="crochet-image">
                    <img src="../image/crochet-image.jpg" alt="How to Crochet">
                </div>
                <div class="crochet-content">
                    <h2>Crochet🧶</h2>
                    <p>
                        Crochet is a handicraft that involves creating fabric by interlocking loops of yarn using a crochet hook. 
                        Unlike knitting, which uses two needles, crochet requires only one hook. This versatile craft offers endless
                         possibilities for creating various items, including clothing, accessories, and home decor.
                    </p>
                    <p>
                        Crocheting is a versatile craft that allows beginners to create beautiful textiles with just a hook and yarn.
                         Begin by learning basic stitches, like the chain stitch and single crochet.
                    </p>
                </div>
            </div>
            <div class="yarn-section">
                <div class="yarn-image">
                    <img src="../image/yarn.jpg" alt="Yarn">
                </div>
                <div class="yarn-text">
                    <h1>What is Yarn?</h1>
                    <p>
                        Structurally, yarn is a continuous strand of intertwined fibers that are held together by their mutual friction.
                         While this is quite a mouthful, all it means is that the individual fiber strands are twisted together so that their 
                         rough outer surfaces adhere to one another.
                    </p>                   
                </div>
            </div>            
            <h1><u>types Of Yarn</u></h1>
            <p><b><u>fiber categories</u></b>
                While there are many possible categories to divide up yarn types, too granular a scheme will be unwieldy. So, we’ll start with the most fundamental three-bucket arrangement based on sources: animal, plant and synthetic.
                
                <p><b><u>Animal Yarns</u></b>
                Animal fiber yarns broadly come in two flavors. On the one hand you have the hair of mammals that moo, maa or otherwise baa. By far the largest share of this market is made of sheep’s wool.
                
                <p><b><u>Plant Fibers</u></b>
                Plant fibers are another popular option. Here, cotton fibers rule the roost. This fine, naturally white, cellulosic fiber makes excellent hypoallergenic yarns. Moreover, it takes dyes really well and is washable. 
                </p> </p></p>    
                <p><b> Synthetic
Synthetic fiber yarns are spun from man-made materials such as acrylic, polyester or polypropylene. They too exhibit some interesting properties, as they are non-shrinking, and usually waterproof. Synthetic fiber yarns are usually less expensive, available in a greater variety of colors and more resistant against the elements.

Categories of Yarn
Now that we understand fiber types, let’s speak about yarns themselves. One of the biggest mistakes is that people make is calling all yarn wool. As we showed you above, not all yarn is woolen. The word yarn refers to the physical form of the material, a spun fibrous strand.

If you really mean wool, say wool, wool yarn or woolen yarn. If you don’t, or you don’t know what fiber it’s made of just say “yarn”.

<p><b>Cotton Yarn
If you look into vintage crochet patterns, you will have come across this style of yarn. It’s most commonly used in lace or fillet crocheting, because it’s thinner, finer and easier to work into intricate shapes. For this reason, a fine 1.75 ml or 2ml hook will be your best bet. Despite being thin, cotton yarn is quite strong.
<p><b><u></u>Matte Cotton
This is a non-shiny fiber that generally refers to untreated (raw) cotton. Matte cotton is a very versatile material excellent for heavy use items, because it’s durable, strong but still quite breathable.

<p>Mercerized Cotton
While some cotton fibers are known to lose shape, mercerized cotton is a treated fiber that has better shape-holding. Unlike matte or untreated cotton, it has a slight sheen to it, and gives projects a different appearance. Mercerized cotton is particularly good for color variety, making it a fabulous choice for kids’ projects.
Wool
Wool also comes in a great variety. Some kinds are very soft like the luxury or premium wools: merino, alpaca and cashmere. Others still are denser and rougher, like 100% sheep’s wool. As wools have natural oils and protective substances, check if the recipient isn’t allergic to wool before embarking on a project.

Individuals that are sensitive or allergic to wool, will find it itchy and hard to wear. In these cases, stick to cotton or synthetic yarns. As it isn’t cheap, make sure you will be able to use it before investing tons of cash.

Silk
You get what you pay for, as the saying goes. While silk yarn is amazing to work with, it costs an arm and a leg. However, it drapes amazingly and is very hypoallergenic.

As silk often makes a finer, thinner yarn it’s also best worked with a fine hook. You can turn a silk yarn into a lovely open lace, a luxury garment or special project for example for weddings.

Linen
While linen yarn is also classified as a luxury yarn, it’s a very traditional fiber that comes in a great variety of thicknesses, from very fine to decidedly bulky. There is no more old-timey yarn for classic homewares and back-to-basics garments.

Hemp and String
This is a rustic yarn perfect for people with more organic tastes. Hemp and string are great to work with because of low cost. However, the rough texture can be hard on your skin as you crochet. It may even cause blisters, so beware.

Synthetics
Nylon
Nylon is very flexible and soft but quite durable. This is why sock yarns usually include it.

Acrylic
This is generally an inexpensive, and somewhat rough synthetic yarn. It may feel itchier than the others. However, the color variety is dizzying and many of the colors are difficult or impossible to attain in a natural fiber.
</div>
<div class="floating-widget">
    <div class="like-btn" id="likeButton">
        <i class="heart-icon"></i>
    </div>
    <div class="share-btn" id="shareButton">
        <i class="share-icon"></i>
        <div class="share-options" id="shareOptions">
            <a href="https://facebook.com" class="facebook" target="_blank">Facebook</a>
            <a href="https://instagram.com" class="instagram" target="_blank">Instagram</a>
            <a href="https://pinterest.com" class="pinterest" target="_blank">Pinterest</a>
        </div>
    </div>
</div> 
</section>        
    
</body>
</html>
</body>
</html>