
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * beginning of footer * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * -->

                        </td>
                        <!--<td id="page_right">
                            <div id="div_side">
                                <? //include("side.php"); ?>
                            </div>
                        </td>-->
                    <tr>
                </table>
            </div> <!-- div_page -->
        </div> <!-- div_page_ww -->
        <!-- page end -->
        
        <!-- footer begin -->
        <div id="div_footer_ww">
            <div id="div_footer">
                <!--<a href="/gp/about">About </a> &nbsp;|&nbsp;
                <a href="/gp/help">Help</a> &nbsp;|&nbsp;
                <a href="/gp/privacy">Privacy</a> &nbsp;|&nbsp;
                <a href="/gp/terms">Terms of Service</a>  &nbsp;|&nbsp;
                <a href="/gp/comments">Comments/Feedback</a> &nbsp;|&nbsp;
                &copy; 2012-->
                
                <table>
                    <tr>
                        <!--<td id="td_footer_left">-->
                            <!--<img src="images/.jpg" alt="HollisWealth" />-->
                        <!--</td>-->
                        <!--<td id="td_footer_center">-->
                        <td id="td_footer_left">
                            <?=$domain?>&nbsp;&copy;&nbsp;2016
                            <!--| <a href="legal">Legal</a>
                            | <a href="privacy">Privacy</a>
                            | <a href="sitemap">Site Map</a>-->
                        </td>
                        <td id="td_footer_center">
                            <a href="http://<?=$mobilesite?>">Mobile&nbsp;Version</a>
                        </td>
                        <td id="td_footer_right">
                            Web Development by <a href="mailto:Laszlo Miok<lmiok36@gmail.com>">Team-X&nbsp;Technologies</a>
                            <!--Web Development by <a href="http://team-x.ca/">Team-X&nbsp;Technologies</a>-->
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- footer end -->
        
        </div><!-- div_body -->
    
    </body> 

</html>

  <?

//Legal  |  Privacy  |  Site Map       Web development by dblack.communications

  // get last update date
  // look at the css, images, and the root directory and get the max date
  //$last_modified_css = date ("F d, Y", filemtime("css/."));
  //$last_modified_images = date ("F d, Y", filemtime("images/."));
  /*$last_modified_root = date ("F d, Y", filemtime("."));
  $last_updated = (max ($last_modified_css, $last_modified_images, $last_modified_root));

  printf ("<table cellspacing='0' border='0' width='100%%'>");
  printf ("<tr>");
  printf ("<td align='left' valign='top'><table cellspacing='0'><tr><td><img src='images/valid-html401-blue.png' alt='Valid HTML 4.01 Strict' height='31' width='88'></td><td valign='top'>Last updated: $last_updated</td></tr></table></td>");
  printf ("<td align='right' valign='top'><a id='comments_footer' href='mailto:lmiok36@hotmail.com'>Comments</a></td>");
  printf ("</tr>");
  printf ("</table>");*/

  ?>
