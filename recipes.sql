-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 20, 2024 lúc 02:09 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `recipes`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `POST_ID` int(11) NOT NULL,
  `COMMENT` text NOT NULL,
  `CREATED_TIME` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`ID`, `USER_ID`, `POST_ID`, `COMMENT`, `CREATED_TIME`) VALUES
(15, 5, 11, 'Công thức rất ngon!', '2024-11-07 01:34:15'),
(16, 6, 11, 'Cảm ơn vì công thức', '2024-11-07 01:36:13'),
(23, 7, 11, 'Hello, thank you for the recipe.', '2024-11-07 01:48:02'),
(38, 4, 11, 'Bình luận của tôi!', '2024-11-19 04:27:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `foods`
--

CREATE TABLE `foods` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `AUTHOR` varchar(255) NOT NULL,
  `UPLOAD` date NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `INGREDIENTS` text NOT NULL,
  `MAIN_IMAGE` text NOT NULL,
  `CATEGORY` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `foods`
--

INSERT INTO `foods` (`ID`, `NAME`, `AUTHOR`, `UPLOAD`, `DESCRIPTION`, `INGREDIENTS`, `MAIN_IMAGE`, `CATEGORY`) VALUES
(1, 'Gnocco Fritto', '\r\nDeborah', '2023-04-06', 'We spent five nights in Emilia Romagna a few years ago, including stays in Bologna, Modena, and Parma. Emilia Romagna is a region well known for its amazing stuffed pasta, and its pork products, so we thoroughly enjoyed eating our way across the region. On our first day in Bologna, we experienced gnocco fritto for the first time, and I believe we ordered it every day after during our stay, it was just that good!|Just imagine airy light puffs of fried dough that served with prosciutto and other salami. The dough puffs are served warm, and when enjoyed with prosciutto, the heat of the dough warms up the prosciutto just enough to bring out the flavor of the meat. Some gnocco fritto are cut into small squares, while others are longer rectangles, which I preferred.|Although the dough is fried, it is so light it does not taste fried. The trick is to ensure that your oil is very hot so that the dough does not absorb too much fat.|Buon Appetito!\r\nDeborah Mele ', '2 Cups Tipo 00 Flour (Pizza Flour) |\r\n3 Teaspoons Active Dry Yeast |\r\n1 Teaspoon Salt |\r\n1 Teaspoon Sugar |\r\n1 Cup Whole Milk |\r\n1/2 Cup Water (As Needed) |\r\n2 Cups Mild Oil For Frying |\r\nThinly Sliced Prosciutto\r\n', 'images/post/1.jpg', 'Antipasti'),
(2, 'Asparagus Arancini Stuffed With Creamy Taleggio Cheese', '\r\nDeborah', '2023-02-04', 'Street food is becoming so popular these days, whether it is sold from food trucks or tiny hole in the wall shops. In Sicily, street food is a way of life, and it almost seems that you cannot walk down any street in Palermo without coming across a shop selling arancini (rice balls), panini con panelle (buns with chickpea fritters), or slices of piping hot sfincione (thick crust Sicilian pizza). We visited Sicily a few years ago, and enjoyed the food tremendously. Even on the ferry from Calabria to Messina, Sicily, they were selling various types of arancini, and other Sicilian street food specialties.|While in Palermo, we came across a shop called Ke Palle which boasted that it sold over 40 types of arancini. I had the best of intentions to try a couple out, but every time we passed the shop we had just eaten and  I-couldn’t-eat-another-bite.|Looking at their website later however, I am sorry that I didn’t make more of an effort, because as well as the traditional rice balls, they had balls made of pasta and other unique ingredients. They even had dessert balls that look very impressive. Oh well, I’ll just have to make my own at home!|As fantastic as that arancini shop was in Palermo, the best rice ball I tasted in Sicily was at a bar attached to a gas station if you can imagine. The arancini was asparagus flavored with a creamy cheese center that oozed out when you bit into it.|The arancini in Sicily tend to be quite large, and in fact, my husband and I shared this asparagus one, but once I got home, I couldn’t get it off my mind. I wasn’t sure what cheese they used in the version I enjoyed in Sicily, but I think it was mozzarella. I used taleggio cheese because first of all it is my absolute favorite Italian cheese, and second of all, it is very creamy, and I knew it would be perfect inside a rice ball. I am very pleased how these arancini turned out as they are very close to the ones I enjoyed so much in Sicily.|To make the best arancini, you need to make the risotto the day before, so the rice cools and gets sticky which holds the arancini together. If you cannot find taleggio, you can use any soft melting cheese such as mozzarella, Brie, or Fontina.|Although I decided to keep my rice balls meatless, you could include a small cube of ham within the center as well as the cheese. I usually make a large batch of these rice balls and freeze most of them. To freeze, once they are coated with breadcrumbs, I place them apart on a baking sheet and freeze them.|Once frozen, I store them in plastic bags until needed. At least four hours before I plan to fry the arancini, I remove them from the freezer and allow them to thaw completely.|Buon Appetito! Deborah Mele', '3 Tablespoons Olive Oil |\r\n2 Tablespoons Butter |\r\n1/2 Cup Finely Chopped Onion |\r\n1 Cup Arborio Rice |\r\n1/2 Cup Dry White Wine |\r\n5 Cups Heated Vegetable or Light Chicken Broth |\r\n1 Bunch Asparagus, Tough Ends Trimmed, Cut Into 1/2 Inch Pieces |\r\nSalt & Pepper |\r\n4 Tablespoons Finely Chopped Basil |\r\n1/2 Cup Grated Parmesan Cheese |\r\n1 Cup All-purpose Flour |\r\n2 Eggs Beaten With 1/3 Cup Milk |\r\n2 Cups Seasoned Breadcrumbs |\r\n6 Ounces of Taleggio (or Another Melting Cheese - See Notes Above) |\r\nOil For Frying\r\n', 'images/post/2.jpg', 'Antipasti'),
(3, 'Caprese Stuffed Zucchini Flowers', '\r\nDeborah', '2023-02-06', 'I love zucchini flowers and although it is difficult finding them here in Florida, if you are lucky enough to have a garden, then you’ll have a constant supply of zucchini flowers all summer long! |\r\nI have tried preparing zucchini flowers in various ways, but this is one of my favorites. |\r\n\r\nThis is the second year that my husband planted zucchini plants that only produce flowers, not zucchini, so every day he brings me at least a dozen zucchini flowers. |\r\nI have tried just about every preparation possible to use up these flowers, and have found that pan-frying them in a little oil after dipping them first in an egg wash and then in seasoned flour is my favorite. |\r\n\r\nYou can either prepare the flowers unstuffed, or stuff them with a cube of mozzarella, some chopped tomatoes, and a little basil as I have done in this recipe. |\r\nBoth methods taste great, and I made these flowers for my family several times this year. |\r\nI have used both safflower oil as well as olive oil for frying and both work well. |\r\nBuon Appetito!\r\nDeborah Mele ', '16 Zucchini Flowers |\r\n16 1-inch Cubes Mozzarella |\r\n1/2 Cup Finely Diced Tomatoes |\r\n3 Teaspoons Finely Chopped Fresh Basil |\r\n2 Large Eggs |\r\n2 Tablespoons Milk |\r\n1 Cup All-purpose Flour |\r\nSalt & Pepper To Taste |\r\n1/2 Teaspoon Dried Oregano |\r\nOil For Frying\r\n', 'images/post/3.jpg', 'Antipasti'),
(4, 'BLT Flatbread', '\r\nDeborah', '2022-02-06', 'We make pizza in our pizza oven every week, and after a lot of trial and error, I found pizza dough is best made fresh each week. |\r\nWhen I do have leftover pizza dough from our weekly pizza night, I divide it up into five-ounce balls and freeze it for flatbreads. |\r\n\r\nPizza dough is stretched by hand, and you want to treat it gently so that the air stays in the dough. |\r\nWith flatbreads, you want a thinner and crispy crust, so I use a rolling pin to roll out my flatbread. |\r\nThese crispy treats are great when entertaining, cut into small squares and served with a glass of wine. |\r\nI also like to serve these flatbreads with a big bowl of soup to make a complete meal. |\r\nYou can use refrigerator leftovers when making your flatbread, or combine any of your favorite ingredients. |\r\n\r\nFor this flatbread, I decided to create toppings used in my favorite sandwich, which is Bacon, Lettuce, & Tomato. |\r\nI used shredded mozzarella cheese, bacon bits, sweet cherry tomatoes, and arugula lettuce which is added after the flatbread has cooled for a few minutes. |\r\nWhen rolling out the dough for flatbread, I roll it into a large oval shape about 1/8th of an inch thick. |\r\n\r\nBuon Appetito! |\r\nDeborah Mele |\r\n', '16 Zucchini Flowers |\r\n16 1-inch Cubes Mozzarella |\r\n1/2 Cup Finely Diced Tomatoes |\r\n3 Teaspoons Finely Chopped Fresh Basil |\r\n2 Large Eggs |\r\n2 Tablespoons Milk |\r\n1 Cup All-purpose Flour |\r\nSalt & Pepper To Taste |\r\n1/2 Teaspoon Dried Oregano |\r\nOil For Frying\r\n', 'images/post/4.jpg', 'Antipasti'),
(5, 'Crispy Fried Shrimp With Spicy Gremolata Topping', '\r\nDeborah', '2022-07-06', 'Whenever I hear of someone planning a trip to Venice, I always recommend that they take a side trip over to the island of Burano. |\r\nThis unique island can be easily reached by water taxi or water bus and is famous for its lacework and brightly colored buildings. |\r\nIt is such a uniquely beautiful little island that it is a popular tourist stop but well worth the visit. |\r\n\r\nWhen we visit Venice we always take the water bus over to Burano to enjoy a spectacular lunch at Gatto Nero, one of the many restaurants found on the island. |\r\nOn a trip a few years ago, I ordered a plate of fried shrimp for lunch, which might sound pretty ordinary, but which was anything but. |\r\nAlthough I love just about any type of seafood, I have a special affection for well prepared shrimp. |\r\nThe shrimp I had at Gatto Nero were sweet and tender, and encased in a light crispy batter and fried just until golden brown. |\r\n\r\nQuite frankly, this might have been one of my all-time favorite shrimp dishes, and I have eaten a LOT of shrimp over the years. |\r\nIf you do plan a visit to Burano and want to dine at Trattoria Gatto Nero, reservations are important because this restaurant gets very busy! (See contact info below) |\r\n\r\nBeing a food fanatic, I had to see if I could replicate this dish at home, so we made a trip to the Venetian fish market the morning we were leaving Venice and bought some fresh, locally caught shrimp to take home with us. |\r\nI did some research on seafood batter, and ended up choosing one I thought most resembled the batter used at Gatto Nero. |\r\n\r\nAfter cleaning my shrimp, I made my batter, and then fried the shrimp for just a couple of minutes in very hot oil. |\r\nThe trick to keeping this batter extra light is to use sparkling water, and when frying use oil brought to a temperature of 375 degrees F. |\r\nI use an oil blend specifically for deep frying, but canola or peanut oil will work just fine. |\r\n\r\nIt is better to fry the shrimps in batches to ensure they cook evenly and quickly and that the batter remains crispy. |\r\nSimply place the cooked shrimp on a tray lined with paper towels to drain while you continue to cook the remaining shrimp. |\r\nAllow the oil to come back to the correct temperature before frying the next batch. |\r\n\r\nBecause fried shrimp is a pretty basic dish, I decided to sprinkle my completed plate with a gremolata type of blend that included fresh parsley, sea salt, a chili pepper, and some lemon zest. |\r\nThis really enhances the flavor of the shrimps and you really do not need anything else although some lemon wedges can be included on the plate when serving. |\r\nYou could serve this dish as an appetizer for 6 to 8, or as a main course for 4 to 6. |\r\n\r\nBuon Appetito! |\r\nDeborah Mele |\r\n', '2 Pounds Fresh Shrimp, Cleaned |\r\n1 Cup All-purpose Flour |\r\n1 Teaspoon Baking Powder |\r\n1/2 Teaspoon Salt |\r\n1 - 1 1/3 Cup Sparkling Water |\r\nOil For Deep Frying (See Notes Above)\r\n\r\n', 'images/post/5.jpg', 'Antipasti'),
(6, 'Focaccia With Peaches & Thyme', '\r\nDeborah', '2023-01-07', 'I will only buy fruit in season, so when local peaches finally show up in our area markets, I tend to go a little overboard. |\r\nMy husband eats a lot of fruit throughout the day, but we sometimes have too many perfectly ripened peaches to eat all at once. |\r\nI like to use peaches while they are at their peak, so I often bake some treats with the ripe peaches, including this unique focaccia bread. |\r\n\r\nThis focaccia is both sweet and savory and could be enjoyed at any time of the day. |\r\nI can envision serving slices of this focaccia to guests as an appetizer with a glass of white wine or serving it with a glass of sweet wine for dessert. |\r\nThe focaccia dough includes just a little sugar and an egg, which ensures that the focaccia is very tender. |\r\n\r\nBuon Appetito! |\r\nDeborah Mele |\r\n', '5 1/2 Cups All-purpose Flour |\r\n1 1/2 Tablespoons Rapid Rise Yeast |\r\n1 Teaspoon Sea Salt |\r\n1 Large Egg |\r\n3 Tablespoons Sugar |\r\n2 Tablespoons Olive Oil |\r\nLuke Warm Water\r\n\r\n', 'images/post/6.jpg', 'Bread'),
(7, 'Banana Bread With Dark Chocolate Chunks', '\r\nDeborah', '2023-04-02', 'When my kids were young, I was making banana muffins studded with chocolate chips every week. |\r\nMy son and daughter loved these moist muffins, and my son in particular, loved them so much that I always had to hide half the batch or they would be gone the same day I made them. |\r\nMy daughter is now making them for her kids, and my sixteen-year-old grandson devours them just as quickly as my son did. |\r\n\r\nMy kids are now grown and have their own families, but every so often I have a craving for something sweet baked with bananas. |\r\nNow that I am baking for myself, I prefer banana bread to muffins, and I use chopped dark chocolate or even bittersweet chocolate in place of the chocolate chips. |\r\n\r\nWhen baking quick breads, I prefer my loaves to have an attractive domed top rather than a flat top, so despite what the recipe calls for, I almost always bake my bread in 8 x 4-inch pans rather than a 9 x 5-inch ones. |\r\nThese loaves are very moist and full of banana flavor and delicious with my morning cup of cappuccino. |\r\n\r\nIf you prefer, feel free to use chocolate chips in place of the chopped chocolate, and although I love to add a little cinnamon to my banana bread, that is an optional ingredient. |\r\nTo create an attractive appearance, save one banana, slice it in half lengthwise, and lay it across the batter before baking. |\r\nThe banana will caramelize and brown and add extra flavor to each bite. |\r\nThis recipe makes two loaves, and I have had great results with freezing one loaf for later. |\r\n\r\nBuon Appetito! |\r\nDeborah Mele |\r\n', '3 1/2 Cups All-purpose Flour |\r\n1 Cup White Sugar |\r\n1 Cup Light Brown Sugar |\r\n1 1/2 Teaspoons Baking Soda |\r\n1 1/2 Teaspoons Ground Cinnamon (optional) |\r\n3/4 Teaspoon Salt |\r\n4 Large Eggs |\r\n3 Cups Mashed Bananas (About 5 to 6 Medium) |\r\n1 Cup Melted Butter, Cooled |\r\n2 Teaspoons Vanilla Extract |\r\n2 Cups Dark Chocolate Chunks (or Chips)\r\n', 'images/post/7.jpg', 'Bread'),
(8, 'Focaccia Stuffed With Prosciutto Cotto, Provolone Cheese & Sun-Dried Tomato Pesto', '\r\nDeborah', '2023-02-01', 'I make some type of focaccia at least once a week. |\r\nMy basic rosemary topped focaccia is my favorite all-round focaccia to use for sandwiches, cut into small squares to serve in place of bread, or to simply snack on, but from time to time I like to play around with my focaccia dough. |\r\n\r\nLast week, I decided to make a stuffed focaccia to serve for lunch. |\r\nI stuffed the focaccia with a homemade sun-dried tomato pesto, slices of prosciutto cotto (cooked ham), and slices of sharp provolone cheese. |\r\nOnce the focaccia had baked to a golden brown, I let it cool for about ten minutes, and then cut it into squares. |\r\n\r\nThe focaccia is a great option to take on a picnic, or to use in packed lunches as it packs really well. |\r\nI froze half of my focaccia squares and then allowed them to thaw before serving. |\r\nI then wrapped them in foil and warmed them in a preheated oven for ten minutes and they tasted freshly made. |\r\n\r\nBuon Appetito! |\r\nDeborah Mele |\r\n', '5 Cups All-purpose Unbleached Flour |\r\n2 Teaspoons Instant Active Dry Yeast |\r\n2 – 3 Tablespoons Extra Virgin Olive Oil (Plus 2 Additional Tablespoons To Oil Bowl) |\r\n1 Teaspoon Salt |\r\n2+ Cups Warm Water |\r\n12 Thin Slices Cooked Ham |\r\n12 Slices Provolone Cheese\r\n', 'images/post/8.jpg', 'Bread'),
(9, 'Meyer Lemon Poppy Seed Loaf', '\r\nDeborah', '2023-04-05', 'Late winter, just before spring arrives, Myer lemons arrive in our stores. |\r\nMyer lemons are a unique variety of citrus that are thought to be a cross between lemons and mandarin oranges. |\r\nMyer lemons are smoother than regular lemons with a deep yellow skin and pulp. |\r\n\r\nAlthough Myer lemons are slightly acidic, they do not have the same tartness of regular lemons. |\r\nI am a sucker for anything lemon flavored, and when I saw my first bag of Myer lemons in the store this year, I had to buy them. |\r\n\r\nLemon loaf is one of my favorite sweets, so I decided to use my Myer lemons to bake a lemon poppy seed quick bread. |\r\nYogurt and oil are used in this recipe creating a very moist bread. |\r\nAlthough I do not normally glaze my cakes or loaves, I thought a bright citrus flavored glaze would bring this dessert to a new level. |\r\n\r\nWhen baking anything lemon flavored, I like to use Fiori di Sicilia from King Arthur Flour. |\r\nThis extract is a flowery blend of lemon and vanilla. |\r\nIf you do not choose to use Fiori di Sicilia you can use half a teaspoon of vanilla extract, and half of a teaspoon of lemon extract. |\r\n\r\nBuon Appetito! |\r\nDeborah Mele |\r\n', '1 1/2 Cups All-purpose Flour |\r\n2 Teaspoons Baking Powder |\r\n1/2 Teaspoon Salt |\r\n1 1/2 Cup Sugar |\r\n1 Cup Greek Yogurt |\r\n1/2 Cup Olive Oil |\r\n1 Teaspoon Fiori di Sicilia (See Notes Above) |\r\n3 Large Eggs At Room Temperature |\r\n1 Large Myer Lemon, Zested And Juiced |\r\n2 Tablespoons Poppy Seeds |\r\n3/4 Cup Powdered Sugar |\r\n', 'images/post/9.jpg', 'Bread'),
(10, 'Apple Rosemary Focaccia', '\r\nDeborah', '2023-05-07', 'I make focaccia at least once a week. |\r\nIt is excellent for snacking on, making sandwiches, and serving at lunch and dinner alongside a bowl of soup or pasta. |\r\nAll of my grandkids love focaccia, and in fact, unless I hide it by freezing some of it, my tray of focaccia rarely lasts an entire day. |\r\n\r\nI usually keep my focaccia toppings simple by drizzling the top with our own extra virgin olive oil, a sprinkling of coarse sea salt, and some chopped fresh rosemary. |\r\nHowever, to keep from getting bored, every once in awhile, I’ll add some chopped olives into the dough. |\r\n\r\nI also like to top my focaccia with some unique toppings such as lemons or other fruit. |\r\nThis particular focaccia is one I made this fall after buying too many locally grown apples. |\r\nI used some of my apples for apple butter, others for roasted applesauce, and made a lot of muffins. |\r\nI used up even more of my apples, making this tasty apple topped focaccia. |\r\n\r\nYou can use any flavorful apple, sliced very thin, and favorite cheese such as Asiago, Gruyere, or even Parmesan. |\r\nFresh rosemary is essential as it gives the bread a lovely light herbal flavor, and do use a good quality extra virgin olive oil. |\r\n\r\nBuon Appetito! |\r\nDeborah Mele |\r\n', '1 Pkg. Active Dry Yeast |\r\n1 1/2 to 2 Cups Warm Water |\r\n5 Cups All-purpose, Unbleached Flour |\r\n1 Teaspoon Salt |\r\n2 Tablespoons Olive Oil |\r\n', 'images/post/10.jpg', 'Bread'),
(11, 'Raspberry & Almond Buttermilk Cake', 'Deborah', '2024-07-10', 'I am still recovering from my hip fracture and following surgery so I am not able to work on new recipes. Fortunately, I had completed a number of new recipes in reserve, that just require posting on the blog. The next few weeks will entail lots of couch surfing, PT, and overall recovery.|When it comes to berries, raspberries are my favorite. Unfortunately, their growing season is relatively short. When I can pick fresh, local raspberries, I do so as soon as I see that the raspberry farms are open. The tart yet sweet flavor of freshly picked raspberries for me is addictive, and the combination of almonds and raspberries works really well in any baked goods.|I constantly say that I do not consider myself a baker as it is one aspect of cooking that I do not really enjoy. Having said that, though, I do seem to bake an awful lot for someone who doesn\'t enjoy baking! When I do bake, it has to be easy to do and not require many fussy steps.|I prefer to bake rustic nut or fruit-based cakes, quick breads, or cookies. This easy cake is a perfect example of the type of baking I like. The cake is quick to assemble and combines ground almonds with fresh, ripe raspberries. The cake is moist and full of flavor, and a small slice is the perfect ending to any meal.|You can serve this cake on its own with a small glass of sweet wine or a cup of coffee or dress it up with a dollop of whipped cream. The choice is yours!|Buon Appetito! Deborah Mele', '1/2 Cup Unsalted Butter, At Room Temperature|2/3 Cup Granulated Sugar|2 Large Eggs At Room Temperature|1 Cup Plus|1 Tablespoon All-purpose Flour|1 1/2 Teaspoons Baking Powder|1/2 Teaspoon Salt|3/4 Cup Blanched Almond Flour|1/2 Cup Buttermilk|1/2 Teaspoon Almond Extract|1/2 Pound Fresh Raspberries, Rinsed', 'images\\post\\11.jpg', 'Dessert'),
(12, 'Raspberry Ricotta Cake', '\r\nDeborah', '2023-08-01', 'I repeatedly say that I am not a baker, but I seem to bake an awful lot for someone who doesn’t love it. However, when I do bake, it is often different types of bread, quick bread, cookies, or rustic cakes that can be pulled together quickly.|This cake is both easy and delicious. I made it as a breakfast option when we had family visiting, and we all enjoyed sampling it as a snack with coffee. Of course, you could always serve it for dessert, with a dollop of whipped cream to dress it up.|The ricotta cheese creates a very moist cake, so you need to refrigerate it after baking. Although I did use fresh raspberries, you could also use frozen raspberries, blackberries, blueberries, or chopped strawberries.|Buon Appetito!\r\nDeborah Mele ', '1 1/2 Cups All-purpose Flour|1 Cup Sugar|2 Teaspoons Baking Powder|1/2 Teaspoon Salt|3 Large Eggs At Room Temperature|1 1/2 Cups Full Fat Ricotta Cheese|1 Teaspoon Vanilla Extract|1/2 Cup (1 Stick) Butter, Melted|1 1/2 Cups Fresh or Frozen Raspberries (See Notes Above)|Powdered Sugar To Garnish', 'images/post/12.jpg', 'Dessert'),
(13, 'Banana Coffee Quick Loaf', 'Deborah', '2024-06-01', 'I like baking quick sweet bread or loaf cakes as they are easy to put together and pretty forgiving. This particular recipe allowed me to use up some over ripe bananas in our freezer which kept the loaves nice and moist and added extra sweetness which allowed me to decrease some of the sugar.|The breads are flavored with some extra strong coffee along with a dash of cinnamon which paired perfectly with the subtle sweetness of the bananas. You might consider coffee to be an odd ingredient in banana bread but actually enhances the banana flavor of this moist loaf.|When sliced, these loaves were very moist with just a subtle coffee flavor. A slice is a perfect addition to my morning cappuccino, or as an afternoon pick-me-up with a shot of espresso.|Buon Appetito! Deborah Mele ', '2 Cups Very Ripe Bananas|3 Large Eggs At Room Temperature|1/2 Cup Vegetable Oil|2 Teaspoons Vanilla Extract|1/2 Cup Strong Coffee|3 Cups All-purpose Flour|1 1/2 Cups Sugar|1 Teaspoon Baking Soda|1 Teaspoon Baking Powder|1 Teaspoon Ground Cinnamon', 'images/post/13.jpg', 'Dessert'),
(14, 'Pumpkin Spice Muffins', 'Deborah', '2020-05-12', 'It is pumpkin spice time again and it is time to enjoy one of my favorite fall flavors yet again. Although Italians do not use winter squash often in desserts, muffins surprisingly enough, are becoming more and more commonplace here in Italy and are sold in many grocery stores and local coffee bars.|Zucca, or pumpkin is also now being sold both cut up into pieces as well as whole in many stores as well as outdoor markets throughout the fall and winter, though here in Italy, it is commonly used in soups, stews, pasta, risotto, or as a vegetable side dish, and not usually in desserts.|I made pumpkin smoothies, pumpkin muffins, pumpkin French toast, pumpkin bread, pumpkin polenta, pumpkin mac and cheese, and pumpkin risotto. These pumpkin muffins were made that day with my big batch of pumpkin puree, and they turned out great. They are moist and tasty, with just enough pumpkin spice flavor. These muffins would be perfect for a quick breakfast on the run, a midday treat or packed into the kid’s school lunch.|I have become a big fan of oat flour recently, both for the texture it adds to baked goods as well as the flavor and added nutritional value. If you find it difficult to locate oat flour near you, simply make your own.|Place regular oats in your food processor or blender, and pulse until you have a powdery texture. I buy my oat flour in the organic section of my regular grocery store back in North America, or at health food stores here in Italy.|Buon Appetito!\r\nDeborah Mele ', '2 1/2 Cups All-purpose Flour |\r\n2 Cups Sugar |\r\n1 Teaspoon Baking Soda |\r\n1 1/2 Teaspoons Ground Cinnamon |\r\n1/2 Teaspoon Ground Nutmeg |\r\n1/2 Teaspoon Ground Ginger |\r\nDash of Salt |\r\n2 Eggs |\r\n1 Cup Cooked or Canned Pumpkin Puree (See Above) |\r\n1/2 Cup Sunflower Seed Oil |\r\n2 Cups Finely Chopped Fresh Pears, Peeled & Cored First\r\n', 'images/post/14.jpg', 'Dessert'),
(15, 'Roasted Applesauce Cake', 'Deborah', '2019-02-02', 'September has arrived, with fall just around the corner. This means we can look forward to new produce arriving at our local markets including a wide variety of apples, fresh figs, grapes, pumpkin, quince, and pears. Many years ago, I posted my favorite way to prepare applesauce which involves roasting the apples, bringing out and enhancing the best flavor possible. One of my favorite recipes to use this delicious Roasted Applesauce is in this rustic applesauce cake, which is delicious for breakfast or a mid-morning snack.| I leave my applesauce slightly chunky, which gives the cake a nice texture, but if you prefer, simply puree the applesauce until smooth. I like a cake such as this one to be finished simply with a sprinkling of powdered sugar, but it would also be wonderful, lightly glazed. You can make an excellent glaze for this cake by mixing apple juice with powdered sugar until you get a smooth consistency, and then simply drizzle this glaze over the cake.|You can also add chopped nuts or raisins to this cake, although I was making it recently for my grandchildren who prefer things plain, so I left all additional additives out for the cake shown in the photos. I also usually substitute some of the all-purpose flour with whole wheat pastry flour or white spelt flour to increase the nutritional value, as shown in the recipe below, but you could also simply use just all-purpose flour if you prefer.|Buon Appetito!\r\nDeborah Mele ', '2 Cups All-purpose Flour |\r\n1 Cup Whole Wheat Pastry Flour |\r\n2 Teaspoons Baking Soda |\r\n1 Teaspoon Salt |\r\n1 Tablespoon Ground Cinnamon |\r\n1 Cup (2 Sticks) Unsalted Softened Butter |\r\n2 Cups Packed Brown Sugar (Light or Dark) |\r\n1/4 Cup Honey (See Notes Above) |\r\n1 Teaspoon Vanilla Extract |\r\n2 Large Eggs |\r\n2 Cups Roasted Applesauce\r\n', 'images/post/15.jpg', 'Dessert');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subscribers`
--

CREATE TABLE `subscribers` (
  `ID` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `subscribers`
--

INSERT INTO `subscribers` (`ID`, `EMAIL`) VALUES
(1, 'Huyyt0911@gmail.com'),
(2, 'Huyvo0911@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `USERNAME` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `ROLE` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`ID`, `NAME`, `USERNAME`, `PASSWORD`, `ROLE`) VALUES
(4, 'Trần Võ Huy', 'admin', '$2y$10$8eCHDGlXJFVu.q6aXeJMy.rc6ajrLG7g.ckdTDimVdB5efZMAwfda', 'admin'),
(5, 'Nguyễn Văn Tân', 'acc1', '$2y$10$MrPwGMDU6ea/HZ31HDDYquO18BlQoKUxza7FQULwVCsyprxhjtXoe', 'user'),
(6, 'Nguyễn Quốc Việt', 'acc2', '$2y$10$XwP4HeT1yzdVb.K9qg4dDOQAONs7E7GNuUE..ts5ou1nVvm4ErLjK', 'user'),
(7, 'Billy', 'wiccan', '$2y$10$EnPcZ5xeiZU3115LX3JTh.9jmj.1kByLQW1YXzDpnYDPyb/CiIpYy', 'user');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `USER_ID` (`USER_ID`),
  ADD KEY `POST_ID` (`POST_ID`);

--
-- Chỉ mục cho bảng `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `foods`
--
ALTER TABLE `foods`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
