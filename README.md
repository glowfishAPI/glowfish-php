
glowfi.sh in PHP for the Big Web: Now with machine guns and rocket launchers
-----------

**Installation**

    Download the folder glowfish and drop it anywhere in your php application.

**Setup**

    require_once('/path/to/glowfish/Glower.php');
    $glower = new Glower('<GLOWFISH_SID>', '<GLOWFISH_AUTH_TOKEN>');

**Useage**

Get ready for some simple machine learning...

*Training*

    $glower->train(array( # the data set
	    'feature_name1' => array(1, 2, 3, 4, ...etc),
	    'feature_name2' => array(9, 4, 5, 6, ...etc)
    ), array( # the response set
	    'class' => array(4, 3, 5, 6, ...etc)
    ))

*Training using CSVs*

    $glower->train_csv('./data_set.csv', './response.csv')

*Predict*
It's important to note that predicting will throw an error if you have not trained against a data set first.

    $glower->predict(array( # the data set
	    'feature_name1' => array(1, 2, 3, 4, ...etc),
	    'feature_name2' => array(9, 4, 5, 6, ...etc)
    ))
    
*Predict using CSVs*

    $glower->predict_csv('./data_set.csv')

*Clustering*

    $glower->cluster(array( # the data set
	    'feature_name1' => array(1, 2, 3, 4, ...etc),
	    'feature_name2' => array(9, 4, 5, 6, ...etc)
    ))

*Clustering using CSVs*

    $glower->cluster_csv('./data_set.csv')

*Feature Selection*

    $glower->feature_select(array( # the data set
	    'feature_name1' => array(1, 2, 3, 4, ...etc),
	    'feature_name2' => array(9, 4, 5, 6, ...etc)
    ), array( # the response set
	    'class' => array(4, 3, 5, 6, ...etc)
    ))
    
*Feature Selection using CSVs*

    $glower->feature_select_csv('./data_set.csv', './response.csv')

**CSV File Format**

*Data Set*

    Feature 1, Feature 2, Feature 3,
    1, 2, 3,
    4, 5, 6,
    7, 8, 9

*Response Set*

    Response Key
    1
    2
    3

**Further Documentation**

Docs - http://glowfish.readme.io/  
Registration - http://glowfi.sh/
