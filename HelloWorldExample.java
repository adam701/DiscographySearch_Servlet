/* $Id: HelloWorldExample.java,v 1.2 2001/11/29 18:27:25 remm Exp $
 *
 */

import java.io.*;
import java.text.*;
import java.util.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.net.*;
import org.w3c.dom.*;
import org.xml.sax.*;
import javax.xml.parsers.*;

/**
 * The simplest possible servlet.
 *
 * @author James Duncan Davidson
 */

public class HelloWorldExample extends HttpServlet {


    public void doGet(HttpServletRequest request,
                      HttpServletResponse response)
        throws IOException, ServletException
    {
        ResourceBundle rb =
            ResourceBundle.getBundle("LocalStrings",request.getLocale());
        response.setContentType("application/json;charset=UTF-8");
	//	request.setContentType("text/html;charset=UTF-8");
        PrintWriter out = response.getWriter();
	String queryText=request.getQueryString();
	
	//	if(request.getRequestURI()==)
       	String urlString="http://cs-server.usc.edu:31259/cgi-bin/get_discographyXML.php?"+queryText;
	//String urlString="http://default-environment-pvqiyjarca.elasticbeanstalk.com/?"+queryText;
	URL url = new URL(urlString);
	URLConnection urlConnection = url.openConnection();
	urlConnection.setAllowUserInteraction(false);
	InputStream urlStream = url.openStream();

	try{
	    DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
	    DocumentBuilder builder = factory.newDocumentBuilder();
	    Document document = builder.parse(urlStream);
	    Element root = document.getDocumentElement();
	    //	    out.println(root.getTagName());
	    out.println("{");
	    out.println("\"results\":{");
	    out.println("\"result\":[");
	    NodeList results= root.getElementsByTagName("result");
	    // out.println(results.getLength());
	    for(int i=0;i<results.getLength();i++){
		Element tempResult=(Element)results.item(i);
		if(queryText.endsWith("choosedType=artists")){
		    out.println("{");
		    out.print("\"cover\":");
		    out.print("\""+(tempResult.getAttribute("cover")).replaceAll("\"","\\&quot")+"\", ");
		    out.print("\"name\":");
		    out.print("\""+(tempResult.getAttribute("name")).replaceAll("\"","\\&quot")+"\", ");
		    out.print("\"genre\":");
		    out.print("\""+(tempResult.getAttribute("genre")).replaceAll("\"","\\&quot")+"\", ");
		    out.print("\"year\":");
		    out.print("\""+(tempResult.getAttribute("year")).replaceAll("\"","\\&quot")+"\", ");
		    out.print("\"details\":");
		    out.print("\""+tempResult.getAttribute("details")+"\"");
		    out.println("}");
		    if(i!=results.getLength()-1){
			out.println(",");
		    }

		}
		else if(queryText.endsWith("choosedType=songs")){
		    out.println("{");
		    out.print("\"sample\":");
		    out.print("\""+(tempResult.getAttribute("sample")).replaceAll("\"","\\&quot")+"\", ");
		    out.print("\"title\":");
		    out.print("\""+(tempResult.getAttribute("title")).replaceAll("\"","\\&quot")+"\", ");
		    out.print("\"performer\":");
		    out.print("\""+(tempResult.getAttribute("performer")).replaceAll("\"","\\&quot")+"\", ");
		    out.print("\"composers\":");
		    out.print("\""+(tempResult.getAttribute("composers")).replaceAll("\"","\\&quot")+"\", ");
		    out.print("\"detail\":");
		    out.print("\""+tempResult.getAttribute("detail")+"\"");
		    out.println("}");
		    if(i!=results.getLength()-1){
			out.println(",");
		    }

		}
		else if(queryText.endsWith("choosedType=albums")){
		    out.println("{");
		    out.print("\"cover\":");
		    out.print("\""+(tempResult.getAttribute("cover")).replaceAll("\"","\\&quot")+"\", ");
		    out.print("\"title\":");
		    out.print("\""+(tempResult.getAttribute("title")).replaceAll("\"","\\&quot")+"\", ");
		    out.print("\"name\":");
		    out.print("\""+(tempResult.getAttribute("name")).replaceAll("\"","\\&quot")+"\", ");
		    out.print("\"year\":");
		    out.print("\""+(tempResult.getAttribute("year")).replaceAll("\"","\\&quot")+"\", ");
		    out.print("\"genre\":");
		    out.print("\""+(tempResult.getAttribute("genre")).replaceAll("\"","\\&quot")+"\", ");
		    out.print("\"details\":");
		    out.print("\""+tempResult.getAttribute("details")+"\"");
		    out.println("}");
		    if(i!=results.getLength()-1){
			out.println(",");
		    }

		}
		
		
	    }
	    out.println("]\n");
	    out.println("}\n");
	    
	    out.println("}");
	}
	catch(Exception e){
	    out.println("REQUESTFAIL!");
	    out.println(e.getMessage());
	    e.printStackTrace(out);
	}
	

	//  String title = rb.getString("helloworld.title");

	//  out.println("<title>" + title + "</title>");
        //out.println("</head>");
        //out.println("<body bgcolor=\"white\">");

	// note that all links are created to be relative. this
	// ensures that we can move the web application that this
	// servlet belongs to to a different place in the url
	// tree and not have any harmful side effects.

        // XXX
        // making these absolute till we work out the
        // addition of a PathInfo issue

	/*	    out.println("<a href=\"/examples/servlets/helloworld.html\">");
        out.println("<img src=\"/examples/images/code.gif\" height=24 " +
                    "width=24 align=right border=0 alt=\"view code\"></a>");
        out.println("<a href=\"/examples/servlets/index.html\">");
        out.println("<img src=\"/examples/images/return.gif\" height=24 " +
                    "width=24 align=right border=0 alt=\"return\"></a>");
        out.println("<h1>" + title +"Chen"+ "</h1>");
        out.println("</body>");
        out.println("</html>");
	*/
    }
}



